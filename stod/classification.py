# coding=utf-8 

# 디렉토리에 "final.csv" 을 필요로 함 

import numpy as np
import csv
import time
import tensorflow as tf
from preprocessing import *
from sklearn.metrics import confusion_matrix
""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
# 모델 hyperparameter

lr = 1e-4
decay = 0.99	
hidden1 = 50
hidden2 = 50	
datanum = 29779
n_classes = 16

""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
#데이터 로딩

data = tonumpy(csvreader("final_%d.csv" %datanum, delimiter = ' '))
data = np.array(data, dtype = "float")

np.random.shuffle(data)
printmax(data)
printmin(data)
data = np.transpose(data)

""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
#dataset 분할

train_set = data[:, 0:int(data.shape[1] * 0.8)]
dev_set = data[:, int(data.shape[1]* 0.8) : int(data.shape[1]* 0.9)]
test_set = data[:, int(data.shape[1]* 0.9):]             # 8 : 1 : 1 로 training / validation / test 을 분할함


""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
# 체온 감소량을 예측할 것이므로 체온 감소량을 제외한 값들을 training에 사용
temp_mask = np.ones(data.shape[0], dtype = "bool")
temp_mask[28] = False                                    

X_train = np.array(train_set[temp_mask], dtype = "float")
temp_train = np.array(train_set[28], dtype = "float")

X_dev = np.array(dev_set[temp_mask], dtype = "float32")
temp_dev = np.array(dev_set[28], dtype = "float32")

X_test = np.array(test_set[temp_mask], dtype = "float32")
temp_test = np.array(test_set[28], dtype = "float32")

X_train = np.transpose(X_train)
X_dev = np.transpose(X_dev)
X_test = np.transpose(X_test)
temp_train = np.transpose(temp_train)
temp_dev = np.transpose(temp_dev)	
temp_test = np.transpose(temp_test)
temp_train = np.squeeze(temp_train)
temp_dev = np.squeeze(temp_dev )
temp_test = np.squeeze(temp_test)

""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
#some tensorflow...

#placeholder
inputs_placeholder = tf.placeholder(tf.float32, (None, X_train.shape[1]), name = "inputs")
temps_placeholder = tf.placeholder(tf.int32, (None, ), name = "temps")

#affine layers
W1 = tf.Variable(tf.random_uniform((X_train.shape[1],hidden1), minval = -np.sqrt(6.0/(X_train.shape[1] + hidden1) ), maxval = np.sqrt(6.0/(X_train.shape[1] + hidden1))), dtype = tf.float32)
b1 = tf.Variable(tf.zeros((hidden1,)) , dtype = tf.float32)
W2 = tf.Variable(tf.random_uniform((hidden1,hidden2), minval = -np.sqrt(6.0/(hidden1 + hidden2)), maxval = np.sqrt(6.0/(hidden1 + hidden2))), dtype = tf.float32)
b2 = tf.Variable(tf.zeros((hidden2,)), dtype = tf.float32)
W3 = tf.Variable(tf.random_uniform((hidden2,n_classes), minval = -np.sqrt(6.0/hidden2), maxval = np.sqrt(6.0/hidden2)), dtype = tf.float32)
b3 = tf.Variable(tf.zeros((n_classes,)), dtype = tf.float32)

#activation : tanh 
z1 = tf.matmul(inputs_placeholder, W1)  + b1
h1 = tf.nn.tanh(z1)
z2 = tf.matmul(h1, W2) + b2
h2 = tf.nn.tanh(z2)
z3 = tf.add(tf.matmul(h2, W3) , b3)  # logits
softmax = tf.nn.softmax(z3, name = "op_to_restore")

#softmax loss
loss = tf.reduce_mean(tf.nn.sparse_softmax_cross_entropy_with_logits(logits = z3, labels = temps_placeholder))
value, pred = tf.nn.top_k(softmax, k=3, sorted = True)




#model 재사용을 위한 saver
saver = tf.train.Saver()

#Adamoptimizer
optimizer = tf.train.AdamOptimizer(lr)	
train_op = optimizer.minimize(loss)

init = tf.global_variables_initializer()
sess = tf.Session()
sess.run(init)

#Training. 100번의 step마다 loss 확인. devset에서 loss가 늘어난 경우에 learning rate를 0.99배로 decay

best_dev = 10
for step in range(5001):
    sess.run(train_op, feed_dict = {inputs_placeholder : X_train, temps_placeholder : temp_train})

    if step%100 == 0:   # 매 스텝마다 질병별 예상 확률과 실제 질병, train_loss, dev_loss 출력
        print(step, sess.run(loss,  feed_dict = {inputs_placeholder : X_train, temps_placeholder : temp_train}), sess.run(loss, feed_dict = {inputs_placeholder : X_dev, temps_placeholder : temp_dev}))
        print(sess.run(softmax[0], feed_dict = {inputs_placeholder : X_train, temps_placeholder : temp_train}))
        print (temp_train[0])
        if best_dev < sess.run(loss, feed_dict = {inputs_placeholder : X_dev, temps_placeholder : temp_dev}) : 
            lr *= decay
            print ("decay")
            print (lr)
        else :
            best_dev = sess.run(loss, feed_dict = {inputs_placeholder : X_dev, temps_placeholder : temp_dev})

print ("test set loss")
print (sess.run(loss, feed_dict = {inputs_placeholder : X_test, temps_placeholder : temp_test}))




print ("top-3 error rate") 
values = (sess.run(value, feed_dict = {inputs_placeholder : X_test, temps_placeholder : temp_test}))
preds =  (sess.run(pred, feed_dict = {inputs_placeholder : X_test, temps_placeholder : temp_test}))

#cm = confusion_matrix(temp_test, preds, labels=range(16))
#print cm
correct = 0.0
for cnt in np.arange(len(preds)) :
  if temp_test[cnt] in preds[cnt]:
    correct += 1
accuracy = correct / len(preds)
print (1 - accuracy)

#save model. predict에서 사용함

save_path = saver.save(sess, 'model1')

	


 











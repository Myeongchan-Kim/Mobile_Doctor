# coding=utf-8 
# regression.py 에서 만든 모델을 바탕으로 예상 감소 체온을 예측해주는 프로그램. example_info에 차례로 체온, 해열제 양, 해열제 섭취 후 경과 시간, 해열제 종류, 체중, 성별, 나이( 단위 : day) 를 입력하면, 예상 감소 체온을 알려주는 프로그램.
import tensorflow as tf
from preprocessing import *
from utils import *

scalable = [29,31]
example_symptoms = (6, 13)
example_baby_info = (15.0, 0, 1140)  # 예시 데이터. 

def predict_temp(symptoms, info): 
    processed_data = np.zeros((32,1))
    for symptom in symptoms:
      processed_data[symptom-1] = 1
    weight, gender, born_date = info
    processed_data[28] = 0 # dummy
    processed_data[29] = weight
    processed_data[30] = gender
    processed_data[31] = born_date
    return processed_data

def pseudonormalize(data): 
    avg = tonumpy(csvreader("avg.csv", delimiter = ' '))
    var = tonumpy(csvreader("var.csv", delimiter = ' '))

    for cnt in np.arange(len(scalable)):
        data[scalable[cnt]] -= float(np.asscalar(avg[cnt]))
        data[scalable[cnt]] /= np.sqrt(float(np.asscalar(var[cnt])))
    return data




""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
# example_info를 모델에 들어갈 수 있게 변환
test = pseudonormalize(predict_temp(example_symptoms, example_baby_info))
time_mask = np.ones(len(test), dtype = "bool")
time_mask[28] = False

""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

#model loading

sess = tf.Session()
saver = tf.train.import_meta_graph("model1.meta")
saver.restore(sess, "model1")

""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
#모델에 예측 체온 넣어 계산
X_test = np.array(test[time_mask], dtype = "float32")
temp_test = np.array(test[28], dtype = "float32")

X_test = np.transpose(X_test)
temp_test = np.transpose(temp_test)
graph = tf.get_default_graph()
temps_placeholder = graph.get_tensor_by_name("temps:0")
inputs_placeholder = graph.get_tensor_by_name("inputs:0")
feed_dict = { inputs_placeholder : X_test, temps_placeholder : temp_test }
op_to_restore = graph.get_tensor_by_name("op_to_restore:0")

value, pred = tf.nn.top_k(op_to_restore, k=3, sorted = True)
""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
#체온 출력

print ("3 estimated disease number, probability")
value, pred = (sess.run((value, pred), feed_dict = feed_dict))
print pred
print value


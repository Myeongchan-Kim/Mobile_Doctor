# coding=utf-8 
# regression.py 에서 만든 모델을 바탕으로 예상 감소 체온을 예측해주는 프로그램. example_info에 차례로 체온, 해열제 양, 해열제 섭취 후 경과 시간, 해열제 종류, 체중, 성별, 나이( 단위 : day) 를 입력하면, 예상 감소 체온을 알려주는 프로그램.
import tensorflow as tf
from preprocessing import *
from utils import *
from merge12 import *
scalable = [0,1,16,18]
example_info = (38.0, 5.0, 3600, 1, 15.0, 0, 1140)  # 예시 데이터. 

def predict_temp(info): 
    temp, volume, time_pass, kind, weight, gender, born_date = info[:]
    final_data = np.zeros((19,1))
    final_data[0] = temp
    final_data[1] = volume
    final_data[2] = time_pass
    final_data[3] = 0.0      # dummy
    final_data[3+kind] = 1.0
    final_data[16] = weight
    final_data[17] = gender
    final_data[18] = born_date
    final_data = np.transpose(final_data)
    final_data = dummyhour(final_data)
    processed_data = addinv(final_data, scalable)
    processed_data = timescale(processed_data)
    processed_data = np.transpose(processed_data)
    return processed_data

def pseudonormalize(data): 
    avg = tonumpy(csvreader("avg.csv", delimiter = ' '))
    var = tonumpy(csvreader("var.csv", delimiter = ' '))

    for cnt in np.arange(len(scalable)):
        data[scalable[cnt]] -= float(np.asscalar(avg[cnt]))
        data[scalable[cnt]] /= np.sqrt(float(np.asscalar(var[cnt])))
    for cnt in np.arange(len(scalable)):
        data[len(data) - len(scalable) + cnt] -= float(np.asscalar(avg[cnt + len(scalable)]))
        data[len(data) - len(scalable) + cnt] /= np.sqrt(float(np.asscalar(var[cnt + len(scalable)])))
    return data




""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
# example_info를 모델에 들어갈 수 있게 변환
test = pseudonormalize(predict_temp(example_info))
time_mask = np.ones(len(test), dtype = "bool")
time_mask[3] = False

""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

#model loading

sess = tf.Session()
saver = tf.train.import_meta_graph("C:\\Users\\MobileDoctor\\1-12\\model.meta")
saver.restore(sess, "C:\\Users\\MobileDoctor\\1-12\\model")

""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
#모델에 예측 체온 넣어 계산
X_test = np.array(test[time_mask], dtype = "float32")
temp_test = np.array(test[3], dtype = "float32")

X_test = np.transpose(X_test)
temp_test = np.transpose(temp_test)

graph = tf.get_default_graph()
temps_placeholder = graph.get_tensor_by_name("temps:0")
inputs_placeholder = graph.get_tensor_by_name("inputs:0")
feed_dict = { inputs_placeholder : X_test, temps_placeholder : temp_test }
op_to_restore = graph.get_tensor_by_name("op_to_restore:0")

""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
#체온 출력

print ("estimated temp")
print (sess.run(op_to_restore, feed_dict = feed_dict))

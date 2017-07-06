#coding=utf-8
# 데이터셋을 합치고 가공하는 과정. 비정상적인 값들을 제거하고, 필요한 feature들을 더 넣어줌.
# 디렉토리에 있는 "disexpt_real2.csv" 파일을 받아 "final%d.csv (% datanum)", "avg.csv", "var.csv" 파일을 저장함. 
import csv
import numpy as np
import time
from utils import *

scalable = [29,31] # 해열제 섭취량, 초기 온도, 체중, 나이의 경우 평균 0, variance 1로 scale 해주는 것이 도움될 것으로 추정됨. scale 가능한 변수들의 index임.  
datanum = 29779  # 사용할 data 개수. 전체 데이터는 백 이십만개이지만 컴퓨터 계산 사양의 한계로 오만 개 정도가 최대로 사용할 수 있는 data 개수인 것 같음.

def regvalue(data):  # dataset에서 regression에 쓸 value만 남김

  total__ = data[:,[7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,38,39,40]]
  return total__


def nanfilter(data,p) : # dataset에서 missing value 지움
  nan= data[:, p] 
  nan_mask = np.zeros_like(nan, dtype = "bool")
  for i in np.arange(len(nan)):
    if ( is_number(nan[i]) ) :
      nan_mask[i] = True
  data = (data[nan_mask])
  return data

def elimoutlier(data): # 체중, 해열제 섭취량이 정상 범위에서 벗어난 것 지움.
  weight = data[:,29]
  weight_mask = np.zeros_like(weight, dtype = "bool")
  for i in np.arange(len(weight)):
    if is_number(weight[i]) and ( float(weight[i]) >=2 ) and (float(weight[i])<=40):
      weight_mask[i] = True
  data = data[weight_mask]
  return data

def tosmallfilter(data):
  kind = data[:,28]
  kind_mask = np.ones_like(kind, dtype = "bool")
  for i in np.arange(len(kind)):
    if kind[i] in [10, 16, 17, 18]:
      kind_mask[i] = False
  data = data[kind_mask]
  return data


def filterwrapper(data): # 위의 5개 filter wrap함
  data1 = data[:datanum]
  data2 = regvalue(data1)
  print data2[0]
  for cnt in np.arange(data2.shape[1]):
    data3 = nanfilter(data2, cnt)
    
  data4 = np.array(data3, dtype = "float") 
  data5 = elimoutlier(data4)  
  data6 = tosmallfilter(data5)
  return data6


def renamekind(data):
  kind = data[:, 28]
  for i in np.arange(len(kind)) :
    if data[i, 28] == 20 :
      data[i, 28] = 16
    if data[i, 28] > 10 :
      data[i,28] -= 1
  return data
  


def normalizescalable(data, scalable) : # scale 가능한 변수와 그것의 역수들을 normalize함. 나중에 평균과 분산을 predict.py에서 사용할 것이기 때문에 csv로 저장.
  avg = np.zeros(len(scalable))
  var = np.zeros(len(scalable))  
  for cnt in np.arange(len(scalable)):
    data[:, scalable[cnt]], avg[cnt], var[cnt] = normalize(data[:, scalable[cnt]])
  return data, avg, var



def oversampling(data, kinds):
  kind = data[:, 28]
  oversamples = np.array(data[0])
  for i in np.arange(len(kind)):
    if kind[i] in kinds:
      oversample = data[i]
      oversamples = np.append(oversamples, oversample)
  oversamples = oversamples.reshape(-1,32)
  data = np.concatenate((data, oversamples), axis = 0)
  return data     


def featureaddwrapper(data) : # 위의 4개 feature 변환 및 추가하는 함수들 wrap함

  data1 = renamekind(data)
  data2 = oversampling(data1, [3,8,9,12,14,15])
  data3 = oversampling(data2, [9,12,14,15])
  data4 = oversampling(data3, [12])
  data5, avg, var = normalizescalable(data4, scalable)


  with open("avg.csv", 'wb') as writer :
    np.savetxt("avg.csv", avg, fmt = '%s', delimiter = ' ')
  
  with open("var.csv", 'wb') as writer : 
    np.savetxt("var.csv", var, fmt = '%s', delimiter = ' ' )
  return data5


def generate_data(datanum, now = False): # 실제로 사용할 data 만들어서 csv로 저장
  if now : 
    data = tonumpy(csvreader("disexpt_real2.csv"))
    data1 = data[:datanum]
    data2 = filterwrapper(data1)
    data3 = featureaddwrapper(data2)
    with open("final_%d.csv" %datanum, 'wb') as writer:
      np.savetxt("final_%d.csv" %datanum, data3, fmt = '%s', delimiter = ' ')



generate_data(datanum, now = False)	

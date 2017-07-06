import csv 
import numpy as np

def csvreader(filename, delimiter = ','):
    fever = []
    with open(filename, 'r') as csvfile:
        feverreader = csv.reader(csvfile, delimiter = delimiter)
        for row in feverreader:
            fever.append(row)
    return fever

def is_number(s):

    try:
        float(s)
        return True
    except ValueError:
        return False

def tonumpy(fever) : 
    fever = np.asarray(fever)
    return fever


def normalize(row):
    avg = np.mean(row)
    row -= avg
    var = np.var(row)
    row /= np.sqrt(var)
    return row, avg, var

def printmax(data):
    print ("max")
    print (np.amax(data, axis = 0))


def printmin(data):
    print ("min")
    print (np.amin(data, axis = 0))

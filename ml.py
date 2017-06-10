
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import csv
from pprint import pprint
from sklearn.metrics import accuracy_score
from sklearn import linear_model
from sklearn.neighbors import KNeighborsClassifier

Race = ["Caucasian","Asian","AfricanAmerican","Hispanic","Other"]
Gender = ["Female","Male","Unknown/Invalid"]
Age=["[0-10)","[10-20)","[20-30)","[30-40)","[40-50)","[50-60)","[60-70)","[70-80)","[80-90)","[90-100)"]
feature=["Down","Up","Steady","No"]
serum =[">200",">300","Norm","None"]
a1c=[">8",">7","Norm","None"]
change=["Yes","Ch","No"]
def conversion(line):
    #0 1 5 10 11 18 19 20
    #for i in filter:
     #   line[i]=-100;
    res=[]
    print(line)
    f=False;
    for i in range(0,len(Race)):
        if Race[i] == line[2]:
            line[2]=i
            f=True
            break
        else :
            f=False;
    if not f:line[2]==-1;
    res.append(line[2])
    ####
    f=False;    
    for i in range(0,len(Gender)):
        if Gender[i] == line[3]:
            line[3]=i
            f=True
            break
        else :
            f=False;
    if  not f:line[3]==-1;
    res.append(line[3])
    ####
    f=False;
    for i in range(0,len(Age)):
        if Age[i] == line[4]:
            line[4]=i
            f=True;   
            break
        else :             
            f=False;
    if not f:line[4]==-1;
    res.append(line[4])
    
    ###
    for i in range(6,10):
        res.append(line[i])
    for i in range(12,18):
        res.append(line[i])
    res.append(line[21])
    ####
    f=False;
    for i in range(0,len(serum)):
        if serum[i] == line[22]:
            line[22]=i
            f=True;   
            break
        else :             
            f=False;            
    if not f:line[22]==-1;
    res.append(line[22])
    ####
    f=False;
    for i in range(0,len(a1c)):
        if a1c[i] == line[23]:
            line[23]=i
            f=True;   
            break
        else :             
            f=False;
    if not f:line[23]==-1;
    res.append(line[23])
    ###        
    ##print(line)
    for i in range(24,len(line)):
        f=False
        
        for j in range(0,len(feature)):
            #print(line[i])
            #print(i)
            #print(line[i])
            #print(change[2])
            if line[i] == feature[j]:
                line[i]=j
                f=True
                break;
            elif line[i]==change[0] or line[i]==change[1]:line[i]=1;f=True;break;
            elif line[i]==change[2]:line[i]=0;f=True;break;
            else:
                f=False
        if f==False:line[i]=-1
        res.append(line[i])
    return [float(x) for x in res]



if __name__ == '__main__':
    #initialize, preprocessing data
    RawData = 'diabetic_data1.csv'
    Diabete_data = []
    target = []
    attr_name = []
    c = 45000
    
    with open(RawData, 'r') as csvfile:
        reader = csv.reader(csvfile, delimiter=',', quotechar='|')
        attr_name = next(reader)[:-1:]
        for line in reader:            
            tmp = conversion(line[0:-1])
            Diabete_data.append(tmp)
            target.append(line[-1])        
                
    ##print ("DONW")            
    ##print (Diabete_data)
    Diabete_data = np.array(Diabete_data)
    target = np.array(target)
    data_transformed=Diabete_data
    target_transformed=target
    """
    data = pd.DataFrame(Diabete_data,columns=attr_name)
    data_transformed = pd.get_dummies(data)
    le = preprocessing.LabelEncoder()
    le.fit(target)
    target_transformed = le.transform(target)
    print(le.classes_)
    """
    #linear 1=manhatun 2=Euclidean 
    #alg="brute"
    pn=1
    k=3
    print(data_transformed)
    print(target_transformed) 
    neigh = KNeighborsClassifier(n_neighbors=k,weights='distance',algorithm="brute",p=2); 
    #Linear Regreesion
    #regr = linear_model.LinearRegression()
    #regr.fit(data_transformed,target_transformed)
    result = neigh.fit(data_transformed,target_transformed)
    #The accurracy rate
    a=result.predict(data_transformed)
    print(a)
    # The coefficients
    #print('Coefficients: \n', result.coef_)
    # The mean squared error
    print("Mean squared error: %.2f"
          % np.mean((result.predict(data_transformed) - target_transformed) ** 2))
    # Explained variance score: 1 is perfect prediction
    print('Variance score: %.2f' % result.score(data_transformed, target_transformed))

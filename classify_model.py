#!/usr/bin/env python
# coding: utf-8
<<<<<<< HEAD
#print("CONGO")
import sys
import numpy as np
d = [sys.argv[1],sys.argv[2]]
#print("You are in model!")
#print(d[0]+' '+d[1]+'/pictures')

path = d[0]+' '+d[1]+'/pictures'

#print(path)
=======

# In[3]:


from flask import Flask


# In[8]:





# In[79]:
>>>>>>> 5ef8503f4dc51bd6223285c2e66271348d5fefa9


def read_format_predict(directory):
    import tensorflow
    import cv2
    import numpy as np
<<<<<<< HEAD
    import os	

=======
    import os
   
>>>>>>> 5ef8503f4dc51bd6223285c2e66271348d5fefa9
    model = tensorflow.keras.models.load_model('m1.h5')
    names=[]
    Images = []
    Labels = []  # 0 for Building , 1 for forest, 2 for glacier, 3 for mountain, 4 for Sea , 5 for Street
    label = 0
    #print("HELLO IN")
    #print(os.listdir(directory))
    label = -1
    for image_file in os.listdir(directory): #Extracting the file name of the image from Class Label folder
            #print("Image is "+image_file)
            image = cv2.imread(directory+r'/'+image_file) #Reading the image (OpenCV)
            image = cv2.resize(image,(150,150)) #Resize the image, Some images are different sizes. (Resizing is very Important)
            Images.append(image)
            Labels.append(label)
            names.append(image_file)
    Images = np.array(Images) #converting the list of images to numpy array.
    Labels = np.array(Labels)
    names = np.array(names)
    results = model.predict(Images) #predict index
    index =[]
    values =[]
    for j in results: #get max  index
        #print(j)
        maxx= -1000
        pos =0
        for i,e in enumerate(j):
            #print(e)
            if e>maxx:
                maxx = e
                pos =i
        index.append(pos)
        values.append(maxx)
    d= {2:'glacier', 4:'sea', 0:'buildings', 1:'forest', 5:'street', 3:'mountain'}
    preds =[]
    for i in index:
        #print(i)
        for j in d.items():
            #print(j)
            if i == j[0]:
                break
<<<<<<< HEAD
        preds.append(j[1]) 
    '''with open('nameLabel.txt','w') as file:
        for i,j in zip(names,preds):
            file.write(str(i)+' '+str(j)+'\n')'''
    with open('image.txt','w') as file:
        for i in names:
            file.write(str(i)+'\n')
    with open('label.txt','w') as file:
        for i in preds:
            file.write(str(i)+'\n')
            
    return results


ans = read_format_predict(path)



with open('confidence.txt','w') as file:
	for i in np.max(ans,axis=1):
		file.write(str(i)+'\n')
'''    for i in ans:
        for j in i:
            print( "%.6f" % float(str(j)),end=" ")
            file.write("%.6f" % float(str(j))+" ")
        file.write("\n")
'''
#print(ans)
=======
        preds.append(j[1])    
    return list(zip(names,preds))


# In[80]:


ans = read_format_predict('F:/YehKiskiPhoto/unknown/pictures')
ans


# In[ ]:



>>>>>>> 5ef8503f4dc51bd6223285c2e66271348d5fefa9


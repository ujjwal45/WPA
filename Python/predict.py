# -*- coding: utf-8 -*-
"""
Created on Thu Mar 29 18:55:58 2018

@author: Anmol
"""

from flask import Flask, redirect, url_for, request, render_template
import csv
import numpy as np
from sklearn import linear_model
app = Flask(__name__)

@app.route('/success/<name>')
def success(name):
   return render_template('wpa.html',show=name)

@app.route('/prediction',methods = ['POST', 'GET'])
def login():
   if request.method == 'POST':
      country = request.form['predict_country']
      year1 = int(request.form['predict_year1'])
      year2 = int(request.form['predict_year2'])
      
      x=[]
      y=[]
      z=[]
      c=['Year','Population']
      for i in range(1960,2017):
          x.append(i)
      with open('fulldata.csv','r') as csvfile:
          csvFileReader = list(csv.reader(csvfile))
          for i in range(1,265):
              if(country==(csvFileReader[i][1])):
                  for j in range(4,61):
                      y.append(csvFileReader[i][j])
      a = list(x)
      b = list(y)
      linear_mod = linear_model.LinearRegression()
      x = np.reshape(x,(len(x),1))
      y = np.reshape(y,(len(y),1))
      linear_mod.fit(x,y)
      for i in range(year1,year2+1):
          predict = linear_mod.predict(i)
          b.append(str(predict[0][0]))     
          a.append(str(i))
      for i in range(len(a)):
        dict1={}
        dict2={}
        dict1[c[0]] = a[i]
        dict2[c[1]] = b[i]
        dict1.update(dict2)
        z.append(dict1)
          
          

      return redirect(url_for('success',name = z))
    #return render_template('index.html',data=z)
if __name__ == '__main__':
   app.run(debug = True)
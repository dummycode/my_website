import sys
import csv

reader = csv.reader(open("summits.csv"), delimiter=";")

summits_sorted = sorted(reader)

writer = csv.writer(open("summits.csv" , "w"))
writer.writerows(summits_sorted)

print(summits_sorted)

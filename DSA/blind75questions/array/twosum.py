# Given an array of integers nums and an integer target, return indices of the two numbers such that they add up to target.

# You may assume that each input would have exactly one solution, and you may not use the same element twice.

# You can return the answer in any order.

def twosum(arr,n,tgt):
    i = 0
    mv = 1
    while(i<n):

        if(arr[i]+arr[mv] == tgt):
            return [i,mv]
        
        elif(mv!=n-1):
            mv+=1
        # elif(mv==n-1):
        else:
            i+=1
            mv = i+1

arr = [2,7,11,15,1]
n = len(arr)
tgt = 18
print(twosum(arr,n,tgt))
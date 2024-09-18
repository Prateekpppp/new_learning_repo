from typing import List

def sort(arr):
    temp = ''
    for j in range(0,len(arr)):
        for i in range(0,len(arr)-j-1):

            if(arr[i]>arr[i+1]):
                temp = arr[i]
                arr[i] = arr[i+1]
                arr[i+1] = temp
    
    return arr


def subArraySum(arr, n, s):

    j = 0
    while(j < n):
        sum = 0
        for i in range(j, n):
            sum += arr[i]
            if(sum == s):
                return j+1,i+1

        j+=1
    return 0


def missing_num(arr,n):
    s_arr = sort(arr)
    i = 0
    while(i < n-1):
        nxt = 0
        nxt +=s_arr[i] + 1

        if(nxt != s_arr[i+1]):
            return nxt
        i+=1
        

def missing_num_2(arr,N):
    N = 5
    total = (N + 1) * (N) / 2

    i = 1
    min = arr[0] 
    while(i < N-1):
        total -= arr[i]
        i+=1
    return total
        

def kadaneAlgorithm(arr):
    i = 0
    out_sum = 0
    cnt = 0
    sub_arr = []
    while(i<len(arr)):
        mx_sum = 0 
        j = i
        while(j<len(arr)):
            
            j+=1
        i+=1
    


def minimunjump(arr, n):
    j = 0
    cnt = 0

    while(j < n):
        if(j < n):
            cnt += 1
            if(j + arr[j] < n-1):
                # cnt += 1
                j += arr[j]
            else:
                j += n-1 -j
                # cnt += 1
                return cnt
        # i+=1
            

def swaping(a,b):
    a = a + b
    b = a - b
    a = a - b
    # print(a,b)
    # return a,b   
# Three-way partitioning method

def n_sort(arr,n):
    
    low = movp = 0
    high = n -1
    while(movp <= high):
        if(arr[movp] == 0):
            arr[movp],arr[low] = arr[low],arr[movp]
            # arr[movp],arr[low] = swaping(arr[movp],arr[low])
            low += 1
            movp += 1

        elif(arr[movp] == 1):
            movp += 1

        else:
            # arr[movp],arr[high] = arr[high],arr[movp]
            arr[movp],arr[high] = swaping(arr[movp],arr[high])
            high -= 1

    return arr

    # while(i<3):
    #     while(j<n):
    #         if(arr[j] == i):
    #             temp.append(arr[j])
    #             # arr.pop(j)
    #         j+=1
    #     j = 0
    #     i+=1
    # return temp 

# arr = [1,2,3,1,2,4,6,4,2]


def duplicatesinarr(arr,n):
    # print(arr)

    # First check all the values that are 
    # present in an array then go to that 
    # values as indexes and increment by 
    # the size of array 

    # for i in range(0, n): 
    #     index = arr[i] % n 
    #     arr[index] += n 

    # print(arr)
    # Now check which value 
    # exists more 
    # than once by dividing 
    # with the size 
    # of array 
    # flag=False
    # res = []
    # for i in range(0,n): 
    #     if (arr[i]//n) > 1: 
    #         res.append(i)
    #         flag=True
    #     print(res)
    
    # if flag==False:
    #     res.append(-1)
    # return res
    
    i = 0
    mv = 1
    rarr = []
    while(i < n-1):
        if(arr[i] == arr[mv]):

            rarr += [arr[i]]
            i += 1
            mv = i+1
        elif(mv < n-1):
            mv += 1
        else:
            i += 1
            mv = i+1

    if(len(rarr)>0):
        arr = rarr
        arr = duplicatesinarr(arr,len(arr))

    # sort the [rarr] array
    

    return arr

def quick_sort(arr,start,end):

    if(start<end):

        p = partition(arr,start,end)
        quick_sort(arr,start,p-1)
        quick_sort(arr,p+1,end)
    return arr

def partition(arr: List[int],start,end) -> int:

    pivot = arr[end]
    i = start - 1 

    for j in range(start,end):
        if(arr[j]<pivot):
            i += 1
            # swaping(arr[j],arr[i])
            if i != j:
                (arr[i], arr[j]) = (arr[j], arr[i])

    # swaping(arr[i+1],arr[end])
    if i+1 != end:
        (arr[i + 1], arr[end]) = (arr[end], arr[i + 1])
    return i+1




arr = [0,2,1,3]
arr = [1,0,1,1,0,1,2,1,2]
# arr = [4 ,3 ,12 ,3 ,12 ,3 ,4 ,4 ,12 ,7 ,11 ,6 ,5]
# print(duplicatesinarr(arr,len(arr)))

# data = [8, 7, 2, 1, 0, 9, 6]
print("Unsorted Array")
print(arr)


quick_sort(arr, 0, len(arr) - 1)

print('Sorted Array in Ascending Order:')
print(arr)
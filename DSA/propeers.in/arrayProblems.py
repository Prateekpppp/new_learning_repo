import sys 

def quick_sort(arr,start,end):

    if(start<end):

        p = partition(arr,start,end)
        quick_sort(arr,start,p-1)
        quick_sort(arr,p+1,end)
    return arr

def partition(arr,start,end) -> int:

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


# You have been given an array/list 'ARR' of integers. Your task is to find the second largest element present in the 'ARR'.
# Note:

# a) Duplicate elements may be present.

# b) If no such element is present return -1.

# from my_utils import quick_sort

def second_largest_element(arr):
    input_arr = quick_sort(arr, 0, len(arr) - 1)
    print(input_arr)
    return input_arr[len(input_arr)-2]





# Given an array 'arr' with 'n' elements, the task is to rotate the array to the left by 'k' steps, where 'k' is non-negative.

def arr_rotate(arr,k):
    arr_l = len(arr)
    i = 0
    j = 0
    
    if(k<=arr_l):
        while(j < arr_l-1):
            arr[j],arr[j+1] = arr[j+1],arr[j]
            
            if(j == arr_l-2):
                j = 0
                i += 1
            else:
                j += 1

            if(i == k):
                return arr
            
    return arr




# Equilibrium Index for Sum

def equilibriumIndexS(arr):

    i = 0
    eq = 1
    arrl = len(arr)
    lsum = 0
    rsum = 0

    while(eq<arrl-1):
        if(i < eq):
            lsum += arr[i]
        elif(i > eq):
            rsum += arr[i]
        
        if(i == arrl-1):
            if(lsum == rsum):
                return eq
            else:
                eq += 1
                i = 0
                lsum = 0
                rsum = 0
        else:
            i += 1
    return -1





# Equilibrium Index for Multiply

def equilibriumIndexM(arr):

print(equilibriumIndexM([-7, 1, 5, 2, -4, 3, 0]))
# Given an array 'arr' with 'n' elements, the task is to rotate the array to the left by 'k' steps, where 'k' is non-negative.


def arr_rotate(arr,k):
    arr_l = len(arr)-1
    if(k<=arr_l):
        
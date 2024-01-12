# Given an integer array nums, return an array answer such that answer[i] is equal to the product of all the elements of nums except nums[i].

# The product of any prefix or suffix of nums is guaranteed to fit in a 32-bit integer.

# You must write an algorithm that runs in O(n) time and without using the division operation.

def productofarrayexceptself(arr):
    i = 0
    mv = 0
    n =len(arr)
    narr = [1]*n
    sm = 1
    while(i<n):
        if(i != mv):
            sm = arr[mv]*sm

        if(mv != n-1):
            mv+=1
        else:   
            narr[i] = sm     
            i+=1
            mv = 0
            sm = 1

    return narr


def productExceptSelf(nums):
    n = len(nums)
    prefix_product = 1
    postfix_product = 1
    result = [0]*n
    for i in range(n):
        result[i] = prefix_product
        prefix_product *= nums[i]
        
    for i in range(n-1,-1,-1):
        result[i] *= postfix_product
        postfix_product *= nums[i]
    return result


arr = [1,2,3,4]
print(productofarrayexceptself(arr))
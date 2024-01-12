def maximumProductSubarray(nums):
    i = 0
    max_so_far = 1
    product = 1
    
    l = len(nums)
    while(i<l):
        product *= nums[i]
        if(product > max_so_far):
            max_so_far = product
        if( nums[i] == 0):
            product = 1
        i+=1

        
    return max_so_far


arr = [-2,1,3,4,-1,2,1,-5,4]
print(maximumProductSubarray(arr))

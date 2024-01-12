def maximumSubarray(nums):
    i = 0
    max_so_far = 0
    max_end = 0
    
    l = len(nums)
    while(i<l):
        max_so_far = max_so_far + nums[i]
        if(max_so_far > max_end):
            max_end = max_so_far
        if(max_so_far < 0):
            max_so_far = 0
        if( i == 0):
            max_end = nums[i]
        i+=1
    return max_end


arr = [-2,1,-3,4,-1,2,1,-5,4]
print(maximumSubarray(arr))

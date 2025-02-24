def maximumProductSubarray(nums):
    
    # Time Complexity: O(N2)
    # res = nums[0]
    # n = len(nums)
    # mvptr = 1
    # for i in range(0,n):
    #     mvptr = nums[i]
    #     for j in range(i+1,n):
    #         res = max(res,mvptr)
    #         mvptr *= nums[j]

    #     res = max(res,mvptr)

    # return res

    # Time Complexity: O(N)
    
    max_ending_here = nums[0]
    max_so_far = nums[0]

    n = len(nums)
    mvptr = 1
    for i in range(1, n):
        max_ending_here = max(nums[i], nums[i] * max_ending_here)
        


arr = [6, -3, -10, 0, 2]
print(maximumProductSubarray(arr))

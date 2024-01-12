def duplicateinarr(nums):
    i = 0
    mv = 1
    n = len(nums)
    while(i < n-1):
        print('nums[i]',i,mv,nums[i],nums[mv])
        if(nums[i] == nums[mv]):
            return 'true'
        elif(mv < n-1):
            mv += 1
        elif(i != n-1):
            i += 1
            mv = i+1
    # return 'false'

    seen = set()
    for num in nums:
        if num in seen:
            return True
        seen.add(num)
    return False


arr = [7,1,5,3,6,4]
arr = [1,2,3,4]
print(duplicateinarr(arr))
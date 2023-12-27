# You are given an array prices where prices[i] is the price of a given stock on the ith day.

# You want to maximize your profit by choosing a single day to buy one stock and choosing a different day in the future to sell that stock.

# Return the maximum profit you can achieve from this transaction. If you cannot achieve any profit, return 0.

from typing import List

def besttimetobuystocks(prices : List[int]):
    i = 0
    mv = 1
    ndiff = 0
    diff = 0
    l = len(prices)
    while(i<l-1):
        ndiff = prices[mv]-prices[i]    
        if(ndiff>diff):
            diff = ndiff

        if(mv!=l-1):
            mv+=1
        elif(i != l-1):
            i+=1
            mv=i+1
    
    return diff
    

def duplicateinarr(nums):
    i = 0
    mv = 1
    n = len(nums)
    while(i < n-1):
        print('nums[i]',nums[i],nums[mv])
        if(nums[i] == nums[mv]):
            return 'true'
        elif(mv < n-1):
            mv += 1
        else:
            i += 1
            mv = i+1
    return 'false'

arr = [7,1,5,3,6,4]
arr = [1,2,3,4]
print(duplicateinarr(arr))
# You have been given an array/list 'ARR' of integers. Your task is to find the second largest element present in the 'ARR'.
# Note:

# a) Duplicate elements may be present.

# b) If no such element is present return -1.

from my_utils import quick_sort
import sys 

def second_largest_element(arr):
    input_arr = quick_sort(arr, 0, len(arr) - 1)
    print(input_arr)
    return input_arr[len(input_arr)-2]


arr = [4 ,3 ,12 ,3 ,12 ,3 ,4 ,4 ,12 ,7 ,11 ,6 ,5]

print(second_largest_element(arr))
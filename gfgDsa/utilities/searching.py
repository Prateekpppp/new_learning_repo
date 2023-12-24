# Binary Searching 

    # Iterative method
    # Recursive method


def binary_method(arr,val):
    i = 0
    l = len(arr)
    mid = int(len(arr)/2)
    while(1):
        if(arr[mid] != val):
            if(arr[mid] > val):
                l = mid
                mid = int((l-i)/2)
            else:
                i = mid
                mid = int((l-i)/2) + i
        else:
            return mid
        

arr = [11, 14, 25, 30, 40, 41, 52, 57, 70]
print(binary_method(arr,57))

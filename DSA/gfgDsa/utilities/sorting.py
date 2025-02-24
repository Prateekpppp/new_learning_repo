    # Bubble Sort
    # Insertion Sort

    # Selection Sort
    # Merge Sort


def bubble_sort(arr):
    
    mv = 0
    j = 0
    while(j<len(arr)-mv-1):
        if(arr[j]>= arr[j+1]):
            arr[j+1],arr[j] = arr[j],arr[j+1]
        j+=1
        if(mv != len(arr)-1 and j == len(arr)-mv-1):
            mv += 1
            j = 0
        if(mv == len(arr)-1):
            break

        # for i in range(0,len(arr)-j-1):

        #     if(arr[i]>=arr[i+1]):
        #         temp = arr[i]
        #         arr[i] = arr[i+1]
        #         arr[i+1] = temp
    
    return arr


def insertion_sort(arr):
    for j in range(1,len(arr)):
        # for i in range(j-1,-1):
        i=j
        temp = arr[j]
        while(i > 0):
            i-=1 
            # print(i,'\n')
            if(arr[i]>=temp):
                arr[i+1] = arr[i]
                arr[i] = temp
            else:
                break
        # print('new')
    return arr    


def selection_sort(arr):
    j = 0
    min = 0
    minIndex = 0
    while(j<len(arr)-1):

        min = arr[j]
        for i in range(j+1,len(arr)):
            if(min > arr[i]):
                min = arr[i]
                minIndex = i

        arr[minIndex] = arr[j]
        arr[j] = min
        j+=1
    return arr


# def merge_sort(arr):

def swaping(a,b):
    # temp = 0
    # temp = a
    # a = b
    # b = temp
    
    a = a + b
    b = a - b
    a = a - b
    return a,b   
    



# ##################################################

# Bubble Sort
# Insertion Sort
# Merge Sort
# Quicksort


def bubbleSorting(arr):
    mv = arrL = len(arr)
    i = 0
    while(i < mv-1):

        if(arr[i] > arr[i+1]):
            arr[i],arr[i+1] = arr[i+1],arr[i]

        if(i == mv-2):
            mv -= 1
            i = 0
        else:
            i+=1
    return arr



def insertionSort(arr):
    
    arrL = len(arr)
    j = 1
    i = 0
    k = arr[1]

    while(j <= arrL-1):
        if(k < arr[i]):
            arr[i+1],arr[i] = arr[i],arr[i+1]
            k = arr[i]
        
        if(i == 0):
            j += 1
            i = j-1
            if(j != arrL):
                k = arr[j]
        else:
            i -= 1
        
        
    return arr



# Divide and Conquer Strategy

def mergeSort(arr):
    










arr = [2,7,3,9,8,1,6,10,67,56,23,45,87,12]

print(insertionSort(arr))
        
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
    

arr = [0,2]
arr = [1,0,1,3,4,4,2,7,2]
arr = [0, -1, -2, -4, 5, 0, -6]
print(bubble_sort(arr))
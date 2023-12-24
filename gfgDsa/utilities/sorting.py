    # Bubble Sort
    # Insertion Sort

    # Selection Sort
    # Merge Sort


def bubble_sort(arr):
    temp = ''
    for j in range(0,len(arr)):
        for i in range(0,len(arr)-j-1):

            if(arr[i]>=arr[i+1]):
                temp = arr[i]
                arr[i] = arr[i+1]
                arr[i+1] = temp
    
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
    
    
print(selection_sort([0, 45, 1,-1,-2, -9,10,11]))
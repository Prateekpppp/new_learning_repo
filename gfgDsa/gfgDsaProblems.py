
def sort(arr):
    temp = ''
    for j in range(0,len(arr)):
        for i in range(0,len(arr)-j-1):

            if(arr[i]>arr[i+1]):
                temp = arr[i]
                arr[i] = arr[i+1]
                arr[i+1] = temp
    
    return arr


def subArraySum(arr, n, s):

    j = 0
    while(j < n):
        sum = 0
        for i in range(j, n):
            sum += arr[i]
            if(sum == s):
                return j+1,i+1

        j+=1
    return 0


def missing_num(arr,n):
    s_arr = sort(arr)
    i = 0
    while(i < n-1):
        nxt = 0
        nxt +=s_arr[i] + 1

        if(nxt != s_arr[i+1]):
            return nxt
        i+=1
        

def missing_num_2(arr,N):
    N = 5
    total = (N + 1) * (N) / 2

    i = 1
    min = arr[0] 
    while(i < N-1):
        total -= arr[i]
        i+=1
    return total
        

def kadaneAlgorithm(arr):
    i = 0
    out_sum = 0
    cnt = 0
    sub_arr = []
    while(i<len(arr)):
        mx_sum = 0 
        j = i
        while(j<len(arr)):
            
            j+=1
        i+=1
    


def minimunjump(arr, n):
    j = 0
    cnt = 0

    while(j < n):
        if(j < n):
            cnt += 1
            if(j + arr[j] < n-1):
                # cnt += 1
                j += arr[j]
            else:
                j += n-1 -j
                # cnt += 1
                return cnt
        # i+=1
            


def n_sort(arr,n):
    temp = []
    i = 0
    j = 0
    while(j<n):
        if(arr[j] == 0):
            i = j
            temp += [arr[j]]
        j+=1

    # while(i<3):
    #     while(j<n):
    #         if(arr[j] == i):
    #             temp.append(arr[j])
    #             # arr.pop(j)
    #         j+=1
    #     j = 0
    #     i+=1
    return temp 

# arr = [1,2,3,1,2,4,6,4,2]
arr = [0,2,1,2,0,1,2,1,0]
print(n_sort(arr,len(arr)))
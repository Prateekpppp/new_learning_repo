# ==============================================
Integer problems

# Count Odd and Even

# def numCount(arr):
#     i = 0
#     odd = 0
#     even = 0
#     arrLen = len(arr)

#     while(i<arrLen):

#         if(arr[i]%2==0):
#             even += 1
#         else:
#             odd += 1

#         i+=1

#     print(odd,even)


# Count Odd and Even using recursion
  
odd = 0
even = 0
i = 0

def numCount(arr,odd,even,i):
    
    arrLen = len(arr)

    if(i<arrLen):

        if(arr[i]%2==0):
            even += 1
        else:
            odd += 1

        i+=1
        return numCount(arr,odd,even,i)

    return (odd,even)



# Program to print the given digit in words

digit_n_words = ["zero", "one", "two", "three", "four","five", "six", "seven", "eight", "nine"]
out_str = ''

def digits_to_words(digit_n_words,out_str,num):

    if(num%10 != 0):
        
        out_str = digit_n_words[num%10] + out_str
        num = int(num/10)
        return digits_to_words(digit_n_words,out_str,num)
    return out_str



# Check if a number is Palindrome

def checkPalindrome(num):
    i = 0
    num = str(num)
    numLen = len(num)
    
    while(i<=numLen/2):
        if(i != numLen-1-i and num[i] != num[numLen-1-i]):
            return False
        i += 1
        
    return True




# program to find square root of a given number

def findSqrt(num):
    low = 1
    high = int(num/2)
    mid = 1

    while(low <= high):
        mid = low + int((high - low)/2)
        midm = mid*mid
        if(midm == num):
            return mid
        elif(midm < num):
            low = mid + 1
        else:
            high = mid - 1
    return low



# Check if given number is perfect square

def checkPerfectSquare(num):
    sqrt = findSqrt(num)
    print('sqrt',sqrt)
    return sqrt*sqrt == num



# # Program to find the maximum element in a Matrix

# def findMaxInMat(mat):
    
#     maxVal = mat[0][0]
#     i = 1
#     j = 1
    
#     while(i<4)



# Sum of Digits of a Number

def sumOfDigits(num):
    sum = 0
    while(num%10 != 0):
        sum += num%10
        num = int(num/10)

    return sum




# Program for Armstrong Numbers


def armstrongCheck(num):
    sum = 0
    org = num
    while(num%10 != 0):
        sum += pow(num%10,3)
        num = int(num/10)

    return sum == org




# Factorial of a Number

def factoial(num):
    fact = 1
    while(num != 1):
        fact *= num
        num = int(num-1)

    return fact



# Check if an Array is Sorted

def arraySortedOrNot(arr,i):

    if(i == len(arr)-1):
        return True
    
    return (arr[i] <= arr[i+1] and arraySortedOrNot(arr,i+1))




# Segregate 0s and 1s in an array

def segregate01(arr):
    arrl = len(arr)
    i = 0
    j = arrl-1

    while(i<j):
        if(arr[i] == 0):
            i += 1
        if(arr[j] == 1):
            j -= 1
        if(arr[i] == 1 and arr[j] == 0):
            arr[i],arr[j] = arr[j],arr[i]
        print(i,j,arr)
    return arr



# Reverse digits

def reverseDigits(num):
    reverse = 0
    while(num%10 != 0):
        reverse = num%10 + reverse* 10
        num = int(num/10)

    return reverse




# ===================================================

# String Problems

# Check if a word is present in a sentence

def isWordPresent(sentence, wrd):
    
    slength = len(sentence)
    i = 0
    twrd = ''
    while(i < slength):

        if(twrd == wrd):
            return True
        
        if(sentence[i] == ' '):
            twrd= ''
        else:
            twrd += sentence[i]
        
        i+=1
    return False


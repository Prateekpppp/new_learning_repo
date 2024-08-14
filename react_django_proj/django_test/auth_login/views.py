from django.shortcuts import render
from django.http import HttpResponse
from django.shortcuts import render

# Create your views here.

def test(request):
    
    return HttpResponse('Hii Jo 2345ythgfdsk')

def test_page(request):
    return render(request, 'test.html')

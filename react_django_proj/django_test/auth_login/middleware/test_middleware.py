import requests
from django.http import HttpResponse

class check_auth_middleware(object):

    def __init__(self,get_response):
         pass


    def login_false(self, request):

        return 'please login'
    

    def login_true(self,request):

        return 'you are logged in'
    

    def __call__(self,request):

        print("Http request is: "+request.method)
        return HttpResponse("Http request is: "+request.method)

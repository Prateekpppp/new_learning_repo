from django.urls import path
from . import views

urlpatterns = [
    path('test', views.test, name='test'),
    path('test_page', views.test_page, name='test_page'),

]

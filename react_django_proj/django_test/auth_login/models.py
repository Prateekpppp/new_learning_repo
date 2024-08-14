from django.db import models
from django.db.models import Model
from django.contrib.auth.hashers import make_password
# Create your models here.

class User(Model):
    username = models.CharField(max_length=200)
    password = models.CharField(max_length=50)

    # class Meta:
    #     db_table = auth_user
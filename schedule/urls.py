from django.urls import path

from . import views

app_name = 'schedule'

urlpatterns = [
    path('', views.index, name='index'),
    path('lesson/<int:lesson_id>/', views.lesson, name='lesson'),
]
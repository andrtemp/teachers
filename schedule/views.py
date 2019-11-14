from django.shortcuts import render
from .models import Class


def index(request):
    classes = Class.objects.all()[:5]
    context = { 'latest_question_list': classes }
    return render(request, 'pages/main.html', context)

def lesson(request, lesson_id):
    return HttpResponse("You're looking at question %s." % lesson_id)
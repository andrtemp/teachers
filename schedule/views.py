from django.shortcuts import render, get_object_or_404
from .models import Class, Lesson, Attendance


def index(request):
    classes = Lesson.objects.all()
    context = {'items': classes}
    return render(request, 'pages/main.html', context)


def lesson(request, lesson_id):
    item = get_object_or_404(Lesson, pk=lesson_id)
    attended = Attendance.objects.filter(lesson=lesson_id, status=True)
    not_attended = Attendance.objects.filter(lesson=lesson_id, status=False)
    context = {
        'lesson': item,
        'attended': attended,
        'not_attended': not_attended
    }
    return render(request, 'pages/lesson.html', context)

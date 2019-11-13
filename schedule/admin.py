from django.contrib import admin

from .models import Class, Subject, Person, Student, Teacher, Lesson, Attendance

admin.site.register(Class)
admin.site.register(Subject)
admin.site.register(Person)
admin.site.register(Student)
admin.site.register(Teacher)
admin.site.register(Lesson)
admin.site.register(Attendance)

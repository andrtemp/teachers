import datetime

from django.test import TestCase
from django.utils import timezone
from django.db.models.query import EmptyQuerySet

from .models import Class, Subject, Person, Student, Teacher, Lesson, Attendance


class LessonModelTests(TestCase):

    def test_is_really_lesson_exist(self):
        attendances = Attendance.objects.all()
        exist = True
        for attendance in attendances:
            try:
                lesson = Lesson.objects.get(pk=attendance.lesson)
            except Question.DoesNotExist:
                exist = False
        self.assertIs(exist, True)

    def test_is_student(self):
        now = timezone.now()
        students = Student.objects.all()
        is_older = False
        for student in students:
            val = student.person.birth_date.timestamp(now) - now
            if val > 0:
                is_older = True
        self.assertIs(is_older, False)

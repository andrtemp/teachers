from django.db import models

class Class(models.Model):
    name = models.CharField(max_length=200)

    def __str__(self):
        return self.name

class Subject(models.Model):
    name = models.CharField(max_length=200)

class Person(models.Model):
    name = models.CharField(max_length=200)
    birth_date = models.DateTimeField()

class Student(models.Model):
    person = models.ForeignKey(Person, on_delete=models.CASCADE)
    class_name = models.ForeignKey(Class, on_delete=models.CASCADE)

class Teacher(models.Model):
    person = models.ForeignKey(Person, on_delete=models.CASCADE)
    subject_name = models.ForeignKey(Class, on_delete=models.CASCADE)

class Lesson(models.Model):
    teacher = models.ForeignKey(Teacher, on_delete=models.CASCADE)
    datetime = models.DateTimeField()
    class_name = models.ForeignKey(Class, on_delete=models.CASCADE)

class Attendance(models.Model):
    student =  models.ForeignKey(Student, on_delete=models.CASCADE)
    lesson =  models.ForeignKey(Lesson, on_delete=models.CASCADE)
    status = models.BooleanField()

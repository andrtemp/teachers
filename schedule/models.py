from django.db import models


class Class(models.Model):
    name = models.CharField(max_length=200)

    def __str__(self):
        return self.name


class Subject(models.Model):
    name = models.CharField(max_length=200)

    def __str__(self):
        return self.name


class Person(models.Model):
    name = models.CharField(max_length=200)
    birth_date = models.DateTimeField()

    def __str__(self):
        return self.name


class Student(models.Model):
    person = models.ForeignKey(Person, on_delete=models.CASCADE)
    class_name = models.ForeignKey(Class, on_delete=models.CASCADE)

    def _get_age(self):
        return self.person.birth_date

    def __str__(self):
        return self.person.name


class Teacher(models.Model):
    person = models.ForeignKey(Person, on_delete=models.CASCADE)
    subject_name = models.ForeignKey(Subject, on_delete=models.CASCADE)

    def __str__(self):
        return self.person.name


class Lesson(models.Model):
    teacher = models.ForeignKey(Teacher, on_delete=models.CASCADE)
    datetime = models.DateTimeField()
    class_name = models.ForeignKey(Class, on_delete=models.CASCADE)
    color = models.CharField(max_length=20, default='#0E8789')

    def __str__(self):
        return "{}. {} ({})".format(self.id, self.teacher.subject_name, self.teacher)


class Attendance(models.Model):
    student = models.ForeignKey(Student, on_delete=models.CASCADE)
    lesson = models.ForeignKey(Lesson, on_delete=models.CASCADE)
    status = models.BooleanField()

    def __str__(self):
        return "{} -> {}".format(self.student, self.lesson)

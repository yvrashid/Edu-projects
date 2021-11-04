#include "newtypes.h"
#include <string>
#include <cstring>
#include <iostream>
#include <limits>
#include "sysfunctions.h"
//������ �����������
Student::Student(const std::string &sur, 
				 const std::string &nam,
				 const std::string &mid, 
				 const float &rating, 
				 const unsigned short &age) {
	
	surname = sur;
	name = nam;
	midname = mid;
	points = rating;
	years = age;
}

//����������� ��-���������
Student::Student() {
	points = 0;
	years = 0;
}

//����������� ����������
Student::Student(const Student &T) {
	surname = T.surname;
	name = T.name;
	midname = T.midname;
	points = T.points;
	years = T.years;	
}

//����������
Student::~Student() {
}
	
//���������� ���������� �����-������
std::istream& operator >>(std::istream &in, Student &obj){
	const int N = 3;
	std::string *temp[N] = {&obj.surname, &obj.name, &obj.midname};
	for (int i = 0; i < N; i++) {
		in >> *temp[i];
		*temp[i] = del_rubbish(*temp[i]);
	}
	in >> obj.points >> obj.years;
	return in;
}

std::ostream& operator <<(std::ostream &out, Student &obj){
	out << obj.surname << " "
		<< obj.name << " "
		<< obj.midname << ", "
		<< obj.points << ", "
		<< obj.years;
	return out;
}	

//���������� ��������� ����������� 
Student& Student::operator =(const Student &other){
	if (this != &other) {
		surname = other.surname;
		name = other.name;
		midname = other.midname;
		points = other.points;
		years = other.years;
	}
	return *this;
}

//���������� ��������� ��������
const bool operator > (const Student &x, const Student &y) {
	return x.points > y.points;
}

//���������� ������� ������

std::string Student::get_surname() const {
	return surname;
}

std::string Student::get_name() const {
	return name;
}

std::string Student::get_midname() const {
	return midname;
}

float Student::get_rating() const {
	return points;
}

unsigned short Student::get_age() const {
	return years;
}

void Student::reset_rating() {
	points = 0;
}

//����������� ��-���������
TeamLeader::TeamLeader() : Student() {
} 
//����������� ����������
TeamLeader::TeamLeader(const TeamLeader &x) : Student(x) {
	tel_num = x.tel_num;
}
//����������� � �����������
TeamLeader::TeamLeader(const std::string &sur, const std::string &nam,
			const std::string &mid, const float &rating, 
			const unsigned short &age, const std::string &t_n) : 
		Student(sur, nam, mid, rating, age) {
	tel_num = t_n;
}

TeamLeader& TeamLeader::operator =(const Student &obj) {
	Student::operator =(obj); 
}

TeamLeader& TeamLeader::operator =(const TeamLeader &obj) {
	Student::operator =(obj); 
	tel_num = obj.tel_num;
}

void TeamLeader::set_phone() {
	std::string str_num;
	std::cin >> str_num;
	str_num = control_phone(str_num);
	tel_num = str_num;
}

void TeamLeader::print() {
	std::cout << "�������: " << surname << std::endl;
	std::cout << "���: " << name << std::endl;
	std::cout << "��������: " << midname << std::endl;
	std::cout << "������� ���� � ��������: " << points << std::endl;
	std::cout << "�������: " << years << std::endl;
	std::cout << "���.: " << tel_num;
}

std::string TeamLeader::get_tel() const {
	return tel_num; 
}
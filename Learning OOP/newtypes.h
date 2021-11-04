#ifndef NEWTYPES_H
#define NEWTYPES_H
#include <iostream>
class Student {
protected:
	std::string surname;
	std::string name;
	std::string midname;
	float points;
	unsigned short years;
public: 	
	//����������� � �����������
	Student(const std::string &, const std::string &, const std::string &, const float &, const unsigned short &); 
	//����������� �����������
	Student(const Student &);
	//����������� ��-���������
	Student();
	//����������
	~Student();
	
	//���������� ���������� �����-������
	friend std:: istream& operator >> (std:: istream &, Student &);
	friend std:: ostream& operator << (std:: ostream &, Student &);
	
	//���������� ��������� ������������
	Student& operator =(const Student &other);
	
	friend const bool operator > (const Student &, const Student &);
	
	//���������� ������� ������
	std::string get_surname() const; //�������� �������
	std::string get_name() const; //�������� ��� 
	std::string get_midname() const; //�������� �������� 
	
	float get_rating() const; //�������� �������	
	unsigned short get_age() const; //�������� �������
	
	void reset_rating(); //����� ��������
	
};

class TeamLeader: public Student {
private:
	std::string tel_num;
public: 
	//����������� ��-���������
	TeamLeader();
	//����������� �����������
	TeamLeader(const TeamLeader &);
	//����������� � �����������
	TeamLeader(const std::string &, const std::string &, const std::string &, const float &, const unsigned short &, const std::string &);
	
	//���������� ��������� ������������
	TeamLeader &operator =(const Student &);
	TeamLeader &operator =(const TeamLeader &);

	void set_phone(); //���������� ����� ��������
	void print(); //����������� ���������� � ��������
	std::string get_tel() const; //�������� ����� �������� ��������
};

#endif	
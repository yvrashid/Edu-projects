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
	//конструктор с параметрами
	Student(const std::string &, const std::string &, const std::string &, const float &, const unsigned short &); 
	//конструктор копирования
	Student(const Student &);
	//конструктор по-умолчанию
	Student();
	//деструктор
	~Student();
	
	//перегрузка операторов ввода-вывода
	friend std:: istream& operator >> (std:: istream &, Student &);
	friend std:: ostream& operator << (std:: ostream &, Student &);
	
	//перегрузка оператора присваивания
	Student& operator =(const Student &other);
	
	friend const bool operator > (const Student &, const Student &);
	
	//объявления методов класса
	std::string get_surname() const; //получить фамилию
	std::string get_name() const; //получить имя 
	std::string get_midname() const; //получить отчество 
	
	float get_rating() const; //получить рейтинг	
	unsigned short get_age() const; //получить возраст
	
	void reset_rating(); //сброс рейтинга
	
};

class TeamLeader: public Student {
private:
	std::string tel_num;
public: 
	//конструктор по-умолчанию
	TeamLeader();
	//конструктор копирования
	TeamLeader(const TeamLeader &);
	//конструктор с параметрами
	TeamLeader(const std::string &, const std::string &, const std::string &, const float &, const unsigned short &, const std::string &);
	
	//перегрузки оператора присваивания
	TeamLeader &operator =(const Student &);
	TeamLeader &operator =(const TeamLeader &);

	void set_phone(); //установить номер телефона
	void print(); //распечатать информацию о старосте
	std::string get_tel() const; //получить номер телефона старосты
};

#endif	
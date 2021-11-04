#ifndef SYSFUNCTIONS_H
#define SYSFUNCTIONS_H
#include <vector>
#include "newtypes.h"

bool keyboard(std::vector <Student> &); //���������� ��������� � ������

bool from_the_file(std:: vector <Student> &); //���������� ������ ��������� �� ������

unsigned char menu_of_fill(); //���� ����������

unsigned char user_menu(); //������� ����

unsigned char menu_of_editing(); //���� ��������������

std::string del_rubbish(std::string &); //��������� � ������ ������ �����

bool removing(std::vector <Student> &); //��������;

bool transfer(std::vector <Student> &, std::vector <Student> &); //����������� �������� � ������ �����������

void edit_info(std::vector <Student> &); //�������������� ���������� � ���������� ��������

float define_rating(const std::vector <Student> &);

bool who_is_lead(const std::vector <Student> &, TeamLeader &);

std::string control_phone(std::string &); //��������� � ������ ������ ����� � ���� "+"

bool student_search(const std::vector <Student> &);

void goodbye_message();

void try_message();

void print_students(std::vector <Student> &);

//������� ��� ������ ������ � ����

void save_to_file(const std::vector <Student> &, const TeamLeader &);

int max_lgth(const std::vector <Student> &);

int lgth(const Student &);
#endif
#ifndef SYSFUNCTIONS_H
#define SYSFUNCTIONS_H
#include <vector>
#include "newtypes.h"

bool keyboard(std::vector <Student> &); //считывание студентов в список

bool from_the_file(std:: vector <Student> &); //считывание списка студентов из файлов

unsigned char menu_of_fill(); //меню заполнения

unsigned char user_menu(); //главное меню

unsigned char menu_of_editing(); //меню редактирования

std::string del_rubbish(std::string &); //оставляет в строке только буквы

bool removing(std::vector <Student> &); //удаление;

bool transfer(std::vector <Student> &, std::vector <Student> &); //перемещение студента в список отпускников

void edit_info(std::vector <Student> &); //редактирование информации о конкретном студенте

float define_rating(const std::vector <Student> &);

bool who_is_lead(const std::vector <Student> &, TeamLeader &);

std::string control_phone(std::string &); //оставляет в строке только цифры и знак "+"

bool student_search(const std::vector <Student> &);

void goodbye_message();

void try_message();

void print_students(std::vector <Student> &);

//функции для записи данных в файл

void save_to_file(const std::vector <Student> &, const TeamLeader &);

int max_lgth(const std::vector <Student> &);

int lgth(const Student &);
#endif
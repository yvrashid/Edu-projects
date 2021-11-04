#include <iostream>
#include <vector>
#include <cstdlib>
#include <algorithm>
#include <functional>
#include "sysfunctions.h"
#include "newtypes.h"

int main() {
	system("chcp 1251");
	float average_score = 0; 
	unsigned char item = 0;
	bool flag = false, flag_x = false; 
	std::vector <Student> list; //список студентов
	std::vector <Student> academ_vacation; //список студентов в академическом отпуске
	//импорт списка или досрочный выход из программы
	do {
		item = menu_of_fill();
		switch (item) {		
			case 48:
				goodbye_message();
				flag = false;
				break;
			case 49:
				flag = from_the_file(list); //чтение из файла
				break;
			case 50:
				flag = keyboard(list);
				break;
			default:
				try_message();
				break;
		}
	} while (item != 48 && !flag);
	//определение старосты и вход в главное меню программы
	if (flag) {
		//определение старосты
		flag = false;
		TeamLeader starosta;
		do {
			flag = who_is_lead(list, starosta);
			if (flag) {
				std::cout << "Уточните номер телефона старосты" << std::endl;
				starosta.set_phone();
			}
		} while (!flag);	
		
		//вход в главное меню программы
		do 
		{
			item = user_menu();
			switch (item) {
				case 48: //выход из программы 
					goodbye_message();
					break;				
				case 49:
					do {
						item = menu_of_editing();
						switch (item) {
							case 48:
								break;
							case 49:
								std::cout << std::endl;
								keyboard(list);
								break;
							case 50:
								std::cout << std::endl;
								flag_x = false;
								flag_x = removing(list);
								if (!flag_x) {
									std::cout << "В списке нет такого студента" << std::endl;
									std::cin.get(); std::cin.get();
								}
								break;
							case 51:
								std::cout << std::endl;
								flag_x = false;
								flag_x = transfer(list, academ_vacation);
								if (!flag_x) {
									std::cout << "В списке нет такого студента" << std::endl;
									std::cin.get(); std::cin.get();
								}
								break;
							case 52:
								std::cout << std::endl;
								edit_info(list);
								break;
							default:
								try_message();
								break;
						}	
					} while (item != 48);
					item = 0;
					break;
				case 50:
					std::cout << "Список студентов группы" << std::endl;
					print_students(list);
					std::cin.get(); std::cin.get();
					break;
				case 51:
					std::cout << "Отсортировано." << std::endl;
					std::sort(list.begin(), list.end(), std::greater<Student>());
					std::cin.get(); std::cin.get();
					break;
				case 52:
					average_score = define_rating(list);
					if (average_score != 0) {
						std:: cout << "Рейтинг студента равен " << average_score << " баллам" << std::endl;
					}
					else {
						std::cout << "В списке нет такого студента" << std::endl;
					}
					std::cin.get(); std::cin.get();
					break;
				case 53:
					if (student_search(list)) {
						std:: cout << "В списке такой студент имеется" << std::endl;
					}
					else {
						std:: cout << "В списке нет такого студента" << std::endl;
					}
					std::cin.get(); std::cin.get();
					break;
				case 54: 
					system("cls");
					std::cout << "||Информация о старосте||" << std::endl;
					starosta.print();
					std::cin.get(); std::cin.get();
					break;
				case 55:
					if (academ_vacation.size() > 0) {
						std::cout << "Студенты, взявшие академический отпуск"<< std::endl;
						print_students(academ_vacation);
					}
					else {
						std::cout << "Таких пока нет" << std::endl;
					}
					std::cin.get(); std::cin.get();
					break;
				
				case 56:
					save_to_file(list, starosta);
					break;
				
				default:
					try_message();
					break;
			}
		} while (item != 48);
	}
	return 0;
}
#include <iostream>
#include <vector>
#include <iomanip>
#include <cstdlib>
#include <cctype>
#include <fstream>
#include <sstream> 
#include "sysfunctions.h"
#include "newtypes.h"
#include <string>
#include <clocale>

static int qty() {
	std::cout << "������� ������� �� ������ �������� � ������? >>> ";
	int n; std::cin >> n;
	return n;
}

bool keyboard(std::vector <Student> &list) { //���������� ������ ��������� � ���������� 
	int n = qty();
	if (n > 0) {
		std:: cout << "������� ���, ������� (����� ���� �������) � ������� ����� ������, ����� ������� Enter" << std::endl;
		for (int i = 0; i < n; i++) {
			Student temp;
			std::cin >> temp;
			list.push_back(temp);
		}
		std::cout << "�����" << std::endl;
		std::cin.get();std::cin.get();
		return true;
	}
	return false;
}

bool from_the_file(std::vector <Student> &list) { //���������� ������ ��������� �� �����
	
	std::cout << "�������� �����: ";
	std::string name_of_file;
	std::cin >> name_of_file;
	name_of_file += ".txt";
	
	std::ifstream fin; 
	std::string sn, name, mn, str; float points_; int years_;
	int n;
	std::stringstream ss;
	
	fin.open(name_of_file, std::ios::in);
	if (!fin.is_open()) { //���� ���� �� ������
		std::cout << "�� ������ ������� ����\n";
		std::cin.get();std::cin.get();
		return false;
	}
	if (fin.peek() == EOF) {
		std::cout << "���� ����\n";
		std::cin.get();std::cin.get();
		return false;
	}
	while (getline(fin, str)) {
		ss << str;
		ss >> sn >> name >> mn >> points_ >> years_;
		sn = del_rubbish(sn);
		name = del_rubbish(name);
		mn = del_rubbish(mn);
		Student temp(sn, name, mn, points_, years_);
		list.push_back(temp);
		ss.clear();
	}
	std::cout << "������ �������" << std::endl;
	std::cin.get();std::cin.get();
	fin.close(); //��������� ����
	return true;
}

unsigned char menu_of_fill() { //���� ����������
	system("cls");
	std:: string menu[] = {"������ ������", "1. �� �����", "2. ������ �������", "0. ��������� ������"};
	const int size_arr = sizeof(menu) / sizeof(std::string);
	for (int i = 0; i < size_arr; i++) {
		std:: cout << menu[i] << std:: endl;
	}
	std:: cout << std:: endl << "�������� ��������: "; 
	unsigned char answer = 0; 
	std:: cin >> answer;
	return answer;
}

unsigned char user_menu(){ //������� ����
	system("cls");
	std:: string menu[] = {"|| ��������� ��� ����� ������������ ��������� � ������ ||",
	"1. �������������� ������", "2. �������� ������",
	"3. ���������� ������ ��������� �� �������� �� �������� (�������� �����)", 
	"4. ������� ������������� ��������", "5. ������� �������� � ������",
	"6. ���������� � ��������", "7. ������������� ������", "8. ��������� � ����",
	"0. ����� �� ���������"};
	const int size_arr = sizeof(menu) / sizeof(std::string);
	for (int i = 0; i < size_arr; i++) {
		std:: cout << menu[i] << std:: endl;
	}
	std:: cout << std:: endl << "�������� ��������: "; 
	char answer = 0; 
	std:: cin >> answer;
	return answer;
}

unsigned char menu_of_editing() { //���� ��������������
	system("cls");
	std:: string menu[] = {"�������������� ������", "1. ��������� ������", "2. ������� �������� �� ������ � ����� � �����������", 
						"3. ����������� � ������ ��������� � ������������� �������", 
						"4. ��������������� ���������� � ��������", "0. ����� � ������� ����"};		
	const int size_arr = sizeof(menu) / sizeof(std::string);
	for (int i = 0; i < size_arr; i++) {
			std:: cout << menu[i] << std:: endl;
	}	
	std:: cout << std:: endl << "�������� ��������: "; 
	unsigned char answer = 0; 
	std:: cin >> answer;
	return answer;
}

std::string del_rubbish(std::string &obj) {
	setlocale(LC_ALL, "rus");//��������� � ������ ������ �����
	std::string tmp; 
	for (int i = 0; i < obj.size(); i++) {		
		if (i == 0 && obj[i] == '-') {
			continue;
		}
		if ((isalpha(obj[i])) || (obj[i] == '-') 
			|| (obj[i]) == '�' || (obj[i] == '�'))  {
			tmp.push_back(obj[i]);
		}

	}
	return tmp;
}

bool removing(std::vector <Student> &list) { //���������� ��������
	std::cout << "������� ��������, ������� ���������� (��������� ������� � ��������� �����) >>> ";
	std::string sur; 
	std::cin >> sur;
	sur = del_rubbish(sur);
	for (int i = 0; i < list.size(); i++) {
		if (sur == list[i].get_surname()) {
			list.erase(list.begin() + i);
			return true;
		}
	}
	return false;
}

bool transfer(std::vector <Student> &list, std::vector <Student> &academ_vacation) { //����������� � ������ �����������
	std::cout << "������� ��������, �������� ������������� ������ (��������� ������� � ��������� �����) >>> ";
	std::string sur; 
	std::cin >> sur;
	sur = del_rubbish(sur);
	for (int i = 0; i < list.size(); i++) {
		if (sur == list[i].get_surname()) {
			list[i].reset_rating();
			academ_vacation.push_back(list[i]);
			list.erase(list.begin() + i);
			return 1;
		}
	}
	return 0;
}

void edit_info(std::vector <Student> &list) { //�������������� ���������� � ���������� ��������
	std::cout << "�������, ��� ������ ��������� ���������������, � ������ ����� ����� >>> ";
	int n; std::cin >> n;
	if (n < list.size()) {
		std::cout << "������ �� ������� ��������� �������� ���������� � ��������" << std::endl;
		system("pause");
		system("cls");
		std:: cout << std::endl << "������� ���, ������� (����� ���� �������) � ������� ����� ������, ����� ������� Enter" << std::endl;
		Student temp; std::cin >> temp;
		list[n-1] = temp;
	}
	else {
		std::cout << "����������� ���������� ����� - ��� " << list.size() << "." << std::endl;
		std::cin.get(); std::cin.get();
	}
}

float define_rating(const std::vector <Student> &list) { //�������, ����������� ������ ������� �������� �� ��� �������
	std::cout << "������� ��������, ��� ������� ����� ������ (��������� � ��������� �����) >>> ";
	std::string sur; 
	std::cin >> sur;
	sur = del_rubbish(sur);
	for (int i = 0; i < list.size(); i++) {
		if (sur == list[i].get_surname()) {
			return list[i].get_rating();
		}
	}
	return 0;
}

bool who_is_lead(const std::vector <Student> &list, TeamLeader &obj) { //���������� ��������
	std::cout << "������� �������� (��������� � ��������� �����) >>> ";
	std::string sur; std::cin >> sur;
	sur = del_rubbish(sur);
	for (int i = 0; i < list.size(); i++) {
		if (sur == list[i].get_surname()) {
			obj = list[i];
			return true;
		}
	}
	return false;
}

std::string control_phone(std::string &obj) { //������� �� ������ �������� ������ �������
	std::string tmp = "\0"; 
	for (int i = 0; i < obj.size(); i++) {
		if ((i == 0) && (obj[i] == '-')) {
			continue;
		}
		else if ((i == 0) && (obj[i] == '+')) {
			tmp.push_back(obj[i]);
		}

		if ((isdigit(obj[i])) || (obj[i] == '-' ))  {
			tmp.push_back(obj[i]);
		}
	}
	return tmp;
}

bool student_search(const std::vector <Student> &list) { //��������� ��������� ������� �������� � ������
	std::cout << "������� ��������, �������� ����� ����� (��������� � ��������� �����) >>> ";
	std::string sur; std::cin >> sur;
	sur = del_rubbish(sur);
	for (int i = 0; i < list.size(); i++) {
		if (sur == list[i].get_surname()) {
			return true;
		}
	}
	return false;
}

void goodbye_message() { //���������� ��������� ����� ������� �� ���������
	std::cout << "������ ��������� ���������. ����� �������" << std::endl;
}

void try_message() { 
	std::cout << "������ �������� ���. ��������� �������. " << std::endl;
	system("pause");
	system("cls");
}

void print_students(std::vector <Student> &list){ //��������� ���������� ���� ������ ���������
	int max = max_lgth(list);
	
	std::cout << "+----+"; 
	for (int i = 0; i < max+2; i++) {
		std::cout << "-";
	}
	std::cout << "+-----------+-------------------" << std::endl;
	
	std::cout << "| �  | " << std::setw(max+1) << std::left << " ��� ��������";
    std::cout << "|  �������  |  ������� ����  " << std::endl; 
	
	std::cout << "+----+"; 
	for (int i = 0; i < max+2; i++) {
		std::cout << "-";
	}
	std::cout << "+-----------+-------------------" << std::endl;

	for (int i = 0; i < list.size(); i++) {
		
		if (list.size() < 9) {
			std::cout << "| " << i+1 << "  |";
		}
		else if ((list.size() >= 9) && (list.size() < 99)) {
			std::cout << "| " << i+1 << " |";
		}
		std::cout << " " << list[i].get_surname() << " " << list[i].get_name() << " " << list[i].get_midname() << " ";
		int size = lgth(list[i]);
		for (int i = 0; i < max - size+1;i++) { 
			std::cout << " ";
		}
		
		std::cout << "|  " << list[i].get_age(); 
		
		if (list[i].get_age() < 10) {
			for (int i = 0; i < 8; i++) {
				std::cout << " ";
			}
		}
		else if (list[i].get_age() > 9 && list[i].get_age() < 100) {
			for (int i = 0; i < 7; i++) {
				std::cout << " ";
			}
		}	
		else if (list[i].get_age() > 99 && list[i].get_age() < 1000) {
			for (int i = 0; i < 6; i++) {
				std::cout << " ";
			}
		}
		
		std::cout << "|  " << list[i].get_rating();
		if (list[i].get_rating() < 10) {
			for (int i = 0; i < 13; i++) {
				std::cout << " ";
			}
		}
		else if (list[i].get_rating() > 9 && list[i].get_rating() < 100) {
			for (int i = 0; i < 12; i++) {
				std::cout << " ";
			}
		}
		else if (list[i].get_rating() > 99 && list[i].get_rating() < 1000) {
			for (int i = 0; i < 11; i++) {
				std::cout << " ";
			}
		}
		
		std::cout << std::endl;
	}
	
	std::cout << "+----+"; 
	for (int i = 0; i < max+2; i++) {
		std::cout << "-";
	}
	std::cout << "+-----------+-------------------" << std::endl;
	
	/*for (int i = 0; i < list.size(); i++) {
		std::cout << list[i] << std::endl;
	}*/
}

void save_to_file(const std::vector <Student> &list, const TeamLeader &x) { //��������� ������ � ����
	std::cout << "������� �������� �����: ";
	std::string name_of_file;
	std::cin >> name_of_file;
	name_of_file += ".txt";
	
	std::ofstream fout; 
	std::string sn, name, mn, str; float points_; int years_;
	int n;
	
	fout.open(name_of_file, std::ios::out);
	
	if (!fout.is_open()) { //���� ���� �� ������
		std::cout << "�� ������ ������� ����\n";
		std::cin.get();std::cin.get();
	}
	
	int max = max_lgth(list);
	
	fout << "+----+"; 
	for (int i = 0; i < max+2; i++) {
		fout << "-";
	}
	fout << "+-----------+-------------------" << std::endl;
	
	fout << "| �  | " << std::setw(max+1) << std::left << " ��� ��������";
    fout << "|  �������  |  ������� ����  " << std::endl; 
	
	fout << "+----+"; 
	for (int i = 0; i < max+2; i++) {
		fout << "-";
	}
	fout << "+-----------+-------------------" << std::endl;

	for (int i = 0; i < list.size(); i++) {
		
		if (list.size() < 9) {
			fout << "| " << i+1 << "  |";
		}
		else if ((list.size() >= 9) && (list.size() < 99)) {
			fout << "| " << i+1 << " |";
		}
		fout << " " << list[i].get_surname() << " " << list[i].get_name() << " " << list[i].get_midname() << " ";
		int size = lgth(list[i]);
		for (int i = 0; i < max - size+1;i++) { 
			fout << " ";
		}
		
		fout << "|  " << list[i].get_age(); 
		
		if (list[i].get_age() < 10) {
			for (int i = 0; i < 8; i++) {
				fout << " ";
			}
		}
		else if (list[i].get_age() > 9 && list[i].get_age() < 100) {
			for (int i = 0; i < 7; i++) {
				fout << " ";
			}
		}	
		else if (list[i].get_age() > 99 && list[i].get_age() < 1000) {
			for (int i = 0; i < 6; i++) {
				fout << " ";
			}
		}
		
		fout << "|  " << list[i].get_rating();
		if (list[i].get_rating() < 10) {
			for (int i = 0; i < 13; i++) {
				fout << " ";
			}
		}
		else if (list[i].get_rating() > 9 && list[i].get_rating() < 100) {
			for (int i = 0; i < 12; i++) {
				fout << " ";
			}
		}
		else if (list[i].get_rating() > 99 && list[i].get_rating() < 1000) {
			for (int i = 0; i < 11; i++) {
				fout << " ";
			}
		}
		
		fout << std::endl;
	}
	
	fout << "+----+"; 
	for (int i = 0; i < max+2; i++) {
		fout << "-";
	}
	fout << "+-----------+-------------------" << std::endl;
	
	fout << "\n\n";
	
	fout << "|__��������_������__|" << std::endl; 
	fout << "�������: " << x.get_surname() << std::endl;
	fout << "���: " << x.get_name() << std::endl;
	fout << "��������: " << x.get_midname() << std::endl;		
	fout << "������� ���� � ��������: " << x.get_rating() << std::endl;
	fout << "�������: " << x.get_age() << std::endl;
	fout << "���.: " << x.get_tel() << std::endl;
	
	fout.close(); //��������� ����
	
	std::cout << "������ ������� ��������" << std::endl;
	std::cin.get();std::cin.get();

}

int max_lgth(const std::vector <Student> &list) {
	int max = 0;
	for (int i = 0; i < list.size(); i++) {
		int size = list[i].get_name().length() + list[i].get_surname().length() + list[i].get_midname().length() + 3;
		if (size > max) {
			max = size;
		}
	}
	return max;
}

int lgth(const Student &obj) {
	int size = obj.get_name().length() + obj.get_surname().length() + obj.get_midname().length() + 3;
	return size;
}
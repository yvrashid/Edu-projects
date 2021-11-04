import tkinter as tk
from tkinter import ttk, Toplevel
import random
import graph as nw

# служебные переменные
a, b, count_nodes, flag, INFINITY, RADIUS = -1, -1, -1, 0, 1000000, 17


# класс для представления графического интерфейса
class GUI:
    # конструктор класса: служит для инициализации объекта класса при создании
    def __init__(self, root, graph):
        self.graph = graph
        self.root = root
        self.root.resizable(width=False, height=False)
        self.root.geometry("800x480+200+100")
        self.root.title("Path of Graph")
        self.root.configure(highlightbackground="#f0f0f0f0f0f0",
                            highlightcolor="#e2e2e2",
                            highlightthickness="9")

        self.canvas = tk.Canvas(root)
        self.canvas.place(relx=0.001, rely=0.001,
                          relheight=0.999, relwidth=0.77)
        self.canvas.configure(background="#ffffff")

        self.style = ttk.Style()
        self.style.configure("TButton",
                             foreground="black",
                             background="white")
        self.style.map("TButton",
                       foreground=[('disabled', 'white'),
                                   ('pressed', 'white'),
                                   ('active', 'white'),
                                   ('selected', 'black')])
        self.style.map("TButton",
                       background=[('disabled', 'white'),
                                   ('pressed', 'black'),
                                   ('active', 'black'),
                                   ('selected', '#4a6984')])
        self.style.map("TButton",
                       relief=[('pressed', 'groove'),
                               ('!pressed', 'ridge')],
                       indicatoron=[('pressed', '#ececec'),
                                    ('selected', '#4a6984')])

        self.TButton1 = ToggleButton(root)
        self.TButton1.place(relx=0.785, rely=0.05,
                            relheight=0.05, relwidth=0.2)
        self.TButton1.configure(text='''Добавить вершины''')
        self.TButton1.configure(command=self.draw_nodes)

        self.TButton2 = ToggleButton(root)
        self.TButton2.place(relx=0.785, rely=0.15,
                            relheight=0.05, relwidth=0.2)
        self.TButton2.configure(text='''Соединить вершины''', takefocus="")
        self.TButton2.configure(command=self.draw_edges)

        self.TButton3 = ToggleButton(root)
        self.TButton3.place(relx=0.785, rely=0.25,
                            relheight=0.05, relwidth=0.2)
        self.TButton3.configure(text='''Очистить всё полотно''', takefocus="")
        self.TButton3.configure(command=self.clear)

        self.TButton4 = ToggleButton(root)
        self.TButton4.place(relx=0.785, rely=0.35,
                            relheight=0.05, relwidth=0.2)
        self.TButton4.configure(text='''Путь из А в B''', takefocus="")
        self.TButton4.configure(command=self.shortest_path)

        self.TSeparator1 = ttk.Separator(root)
        self.TSeparator1.place(relx=0.785,
                               rely=0.774, relwidth=0.2)

        self.Label = tk.Label(root)
        self.Label.place(relx=0.785, rely=0.776,
                         relwidth=0.2, relheight=0.04)
        self.Label.configure(text='Результат алгоритма',
                             foreground="black",
                             font=("Arial", "8"))

        self.Message = tk.Message(root)
        self.Message.place(relx=0.785, rely=0.807,
                           relwidth=0.2, relheight=0.18)
        self.Message.configure(text='Здесь будет показан результат',
                               foreground="black", font=("Arial", "13"),
                               anchor='center', justify='center')

    # метод запуска инструмента рисования вершин графа
    def draw_nodes(self):
        self.TButton1.change_state()
        if self.TButton1.get_state() is True:
            if self.TButton2.get_state() is True:
                self.TButton2.change_state()
            if self.TButton3.get_state() is True:
                self.TButton3.change_state()
            if self.TButton4.get_state() is True:
                self.TButton4.change_state()
            self.canvas.bind('<Button-1>', self.draw_n)
        else:
            self.canvas.unbind('<Button-1>')
            return

    # отвечает за рисование одной вершины
    def draw_n(self, event):
        global count_nodes
        count_nodes += 1
        x = event.x
        y = event.y
        graphic_shape = self.canvas.create_oval(x-RADIUS, y-RADIUS,
                                                x+RADIUS, y+RADIUS,
                                                fill=generate_color(),
                                                outline="black",
                                                tag=str(count_nodes),
                                                activefill="#ECDADA")
        graphic_text = self.canvas.create_text(x, y,
                                               text=count_nodes,
                                               fill="white",
                                               font=("Arial", 11, 'italic'),
                                               tag=str(count_nodes),
                                               activefill="white")
        self.graph.add_node(Node(str(count_nodes),
                                 x, y, graphic_shape,
                                 graphic_text))

    # метод запуска инструмента рисования рёбер графа
    def draw_edges(self):
        self.TButton2.change_state()
        if self.TButton2.get_state() is True:
            if self.TButton1.get_state() is True:
                self.TButton1.change_state()
            if self.TButton3.get_state() is True:
                self.TButton3.change_state()
            if self.TButton4.get_state() is True:
                self.TButton4.change_state()
            self.canvas.bind('<Button-1>', self.draw_e)
        else:
            self.canvas.unbind('<Button-1>')
            return

    # отвечает за рисование одного ребра графа
    def draw_e(self, event):
        global flag, a, b
        for e in self.graph.nodes:
            if ((e.get_point().get_xp() - event.x) ** 2 +
                (e.get_point().get_yp() - event.y) ** 2) <= (
                    RADIUS ** 2):
                if 0 <= flag < 2:
                    flag += 1
                    if flag == 1:
                        a = e.get_name()
                    else:
                        b = e.get_name()

        if (flag == 2) and (a != b) and\
                (not (b in (self.graph.edges.get(a, ())))):
            self.modal_win()
            if self.weight() is not INFINITY:
                self.graph.add_edge(str(a), str(b), self.weight())
                v1 = self.graph.get_node(a)
                v2 = self.graph.get_node(b)
                x1 = v1.get_point().get_xp()
                y1 = v1.get_point().get_yp()
                x2 = v2.get_point().get_xp()
                y2 = v2.get_point().get_yp()
                self.canvas.create_line(x2+4, y2+4,
                                        x1+4, y1+4,
                                        width=2, fill="grey",
                                        smooth=True,
                                        activefill="grey",
                                        activedash=(5, 4),
                                        arrow=tk.FIRST,
                                        capstyle=tk.ROUND)
                x = (x1+x2)/2
                y = (y1+y2)/2
                self.canvas.create_text(x+20, y+20,
                                        text=str(self.weight()),
                                        fill="black",
                                        font=("Arial", "13", 'bold'),
                                        activefill="grey")
        if flag == 2:
            a = b = -1
            flag = 0

    # очищает полотно рисования
    def clear(self):
        self.TButton3.change_state()
        if self.TButton3.get_state() is True:
            if self.TButton1.get_state() is True:
                self.TButton1.change_state()
            if self.TButton2.get_state() is True:
                self.TButton2.change_state()
            if self.TButton4.get_state() is True:
                self.TButton4.change_state()
            global count_nodes, a, b, flag
            a, b, flag, count_nodes = -1, -1, 0, -1
            self.canvas.delete("all")
            self.graph.clear()
            self.Message.configure(text='Здесь будет показан результат',
                                   foreground="black", font=("Arial", "10"),
                                   anchor='center', justify='center')
        else:
            self.canvas.unbind('<Button-1>')
            return

    # открывает диалоговое окно ввода веса графа
    def modal_win(self):
        self.root.dialog = InputDialog(self.root)

    # возвращает вес ребра
    def weight(self):
        return self.root.dialog.get_weight()

    # метод запуска инструмента,
    # вычисляющего кратчайшее расстояние между двумя вершинами в графе
    def shortest_path(self):
        self.TButton4.change_state()
        if self.TButton4.get_state() is True:
            if self.TButton1.get_state() is True:
                self.TButton1.change_state()
            if self.TButton2.get_state() is True:
                self.TButton2.change_state()
            if self.TButton3.get_state() is True:
                self.TButton3.change_state()
            self.canvas.bind('<Button-1>', self.process)
        else:
            self.canvas.unbind('<Button-1>')
            return

    # метод, запускающий алгоритм Дейкстры
    def process(self, event):
        global flag, a, b
        for e in self.graph.nodes:
            if ((e.get_point().get_xp() - event.x) ** 2 +
                (e.get_point().get_yp() - event.y) ** 2) <= (
                    RADIUS ** 2):
                if 0 <= flag < 2:
                    flag += 1
                    if flag == 1:
                        a = e.get_name()
                    else:
                        b = e.get_name()
        if flag == 2:
            path = nw.algorithm(self.graph, a, b)
            res_str = "S("+str(a)+"->"+str(b)+") = "
            if nw.length > 0:
                res_str += '=>'.join(path) + "=" + str(nw.length)
            elif nw.length == 0:
                res_str = "S("+str(a)+"->"+str(b)+") = 0"
            else:
                res_str += ''.join(path)
            self.Message.config(text=res_str, font=("Arial", "10"))
            a = b = -1
            flag = 0


# класс диалогового окна
class InputDialog:
    # конструктор класса: служит для инициализации объекта класса при создании
    def __init__(self, root):
        self.weight = INFINITY
        self.slave = Toplevel(root)
        self.slave.overrideredirect(1)
        self.slave.resizable(width=False, height=False)
        self.slave.geometry("300x150+500+300")
        self.slave.configure(highlightbackground="#f0f0f0f0f0f0",
                             highlightcolor="#e2e2e2",
                             highlightthickness="9")

        self.Label = tk.Label(self.slave)
        self.Label.place(relx=0.001, rely=0.1, relwidth=0.999, relheight=0.2)
        self.Label.configure(text='Вес ребра',
                             background="#f0f0f0", foreground="#a3a3a3",
                             font=("Arial", "16"))

        self.TEntry = ttk.Entry(self.slave)
        self.TEntry.place(relx=0.02, rely=0.5, relheight=0.2, relwidth=0.455)

        self.TButton1 = ttk.Button(self.slave)
        self.TButton1.place(relx=0.48, rely=0.5,
                            relheight=0.2, relwidth=0.250)
        self.TButton1.configure(text='Готово', takefocus="",
                                command=self.set_weight)

        self.TButton2 = ttk.Button(self.slave)
        self.TButton2.place(relx=0.73, rely=0.5,
                            relheight=0.2, relwidth=0.250)
        self.TButton2.configure(text='Отмена', takefocus="",
                                command=self.set_inf)

        self.slave.grab_set()
        self.slave.focus_set()
        self.slave.wait_window()

    # проверяет, удовлетворяет ли введенный вес
    # минимальным требованиям и если да, то закрывает диаологовое окно ввода
    def set_weight(self):
        try:
            self.weight = int(self.TEntry.get())
            if self.weight > 0:
                self.slave.destroy()
        except ValueError:
            pass

    # позволяет отменить рисование ребра между выбранными вершинами
    def set_inf(self):
        self.weight = INFINITY
        self.slave.destroy()

    # служит для возвращения полученного веса ребра за пределы диалогового окна ввода
    def get_weight(self):
        return self.weight


# класс для представления одной вершины графа
class Node:
    def __init__(self, name, x, y, g_r=None, g_t=None):
        self.name = name
        self.point = Point(x, y)
        self.g_r = g_r
        self.g_t = g_t

    def get_point(self):
        return self.point

    def get_name(self):
        return self.name

    def get_gr(self):
        return self.g_r

    def get_gt(self):
        return self.g_t

    def print_node(self):
        print(str(self.name) + ": " +
              str(self.point.x) + ', ' +
              str(self.point.y))


# класс для представления кнопки-переключателя
class ToggleButton(ttk.Button):
    def __init__(self, relative=None, state=False):
        ttk.Button.__init__(self, relative)
        self.state = state

    def change_state(self):
        self.state = not self.state
        return self.state

    def get_state(self):
        return self.state


# класс для представления точки на экране
class Point:
    def __init__(self, x=0, y=0):
        self.x = x
        self.y = y

    def set_coordinates(self, x, y):
        self.x = x
        self.y = y

    def get_xp(self):
        return self.x

    def get_yp(self):
        return self.y


# генератор случайного цвета
def generate_color():
    color = '#{:02x}' \
            '{:02x}' \
            '{:02x}'.format(*map(lambda x: random.randint(0, 255), range(3)))
    return color

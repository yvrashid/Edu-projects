from tkinter import Tk
import graph as nw
import classes as system_classes


parent = Tk()
g = nw.Graph() # создание графа
w = system_classes.GUI(parent, g)
parent.mainloop()

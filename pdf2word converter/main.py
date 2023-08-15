#  from pdf2docx import Converter, parse
from tkinter import filedialog
# from PyPDF2 import PdfReader
# import aspose.words as aw
# from docx import Document
# from pathlib import Path
#import customtkinter as ctk
from tkinter import ttk
from tkinter import *
# import PyPDF2
import os


class PDF2Word:
    def __init__(self, root):
        self.root = root
        self.screenwidth = self.root.winfo_screenwidth()
        self.screenheight = self.root.winfo_screenheight()
        self.align_str = '%dx%d+%d+%d' % (300, 500, (self.screenwidth - 300) / 2, (self.screenheight - 500) / 2)
        self.root.geometry(self.align_str)
        self.root.resizable(False, False)
        self.root.title("PDF to Word Converter")
        self.icon = PhotoImage(file="appicon.png")
        self.root.iconphoto(True, self.icon)

        self.lastfile_frame = LabelFrame(self.root, text="the last file", background="#ffe4c4")
        self.actions_frame = LabelFrame(self.root, text="actions", bg="#6667AB", foreground="white")

        self.lastfile_frame.pack(fill=BOTH, expand=True)
        self.actions_frame.pack(fill=X, side=BOTTOM)

        self.current_filelabel = ttk.Label(self.lastfile_frame, text="No Selected",
                                           background="#FFCDD2", foreground="#B71C1C")
        self.current_filepath = 'No selected'

        self.convert_flag = False
        self.extract_flag = False

        self.select_filebutton = Button(self.actions_frame,
                                            text="select PDF File",
                                            command=self.open_file)

        self.convert_button = Button(self.actions_frame,
                                         text="convert PDF to Word",
                                         )

        self.extract_button = Button(self.actions_frame,
                                         text="extract text from PDF to Word",
                                         )

        self.current_filelabel.pack(fill=X)
        self.select_filebutton.pack(ipady=3, fill=X)
        self.convert_button.pack(ipady=3, fill=X)
        self.extract_button.pack(ipady=3, fill=X)

    def open_file(self):
        self.convert_flag = False
        self.extract_flag = False
        filepath = filedialog.askopenfilename(initialdir=os.getcwd(),
                                              title="Open PDF File",
                                              filetypes=[("PDF File", ".pdf")])
        if filepath != "":
            filename = os.path.basename(f'{filepath}')
            self.current_filelabel.configure(text=filename)
            self.current_filepath = filepath
            # print(filename)


def main():
    root = Tk()
    PDF2Word(root)
    root.mainloop()


if __name__ == '__main__':
    main()

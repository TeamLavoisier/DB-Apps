﻿using SupermarketsChain.Interfaces;
using SupermarketsChain.Tasks;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SupermarketsChain
{
    class Application
    {
        private static Application instance = null;

        private string line = "";

        private Application()
        {

        }

        private bool CanRecieveInput()
        {
            return this.line != "exit";
        }

        public static Application Run()
        {
            if (instance == null)
            {
                instance = new Application();
                instance.ExecuteEventLoop();
            }

            return instance;
        }

        public void TearDown()
        {

        }

        private void ParseInput()
        {
            ITask task;
            string[] data = this.line.Split();
            switch (data[0])
            {
                case "generate-xml-report":
                    task = new JSONtoXML();
                    break;
                case "generate-mongodb-reports":
                    task = new MongoDBReports();
                    break;
                case "xml-import":
                    task = new XMLImport();
                    break;
                case "generate-pdf":
                    task = new GeneratePDF();
                    break;
                case "load-reports":
                    throw new NotImplementedException();
                    //task = new ExcelImport();
                    break;
                case "mysql-import":
                    throw new NotImplementedException();    
                    //task = new MySQLImport();
                    break;
                default:
                    throw new ArgumentException("Invalid input");
            }

            task.Run(data);
        }

        private void ExecuteEventLoop()
        {
            this.line = Console.ReadLine();

            while (this.CanRecieveInput())
            {
                try {
                    this.ParseInput();
                } catch (Exception e) {
                    Console.WriteLine(e.Message);
                }

                this.line = Console.ReadLine();
            }
        }
    }
}
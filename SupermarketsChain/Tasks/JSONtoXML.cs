using SupermarketsChain.Helpers;
using SupermarketsChain.Interfaces;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Xml;
using System.Runtime.Serialization.Json;
using System.Xml.Linq;

namespace SupermarketsChain.Tasks
{
    class JSONtoXML : ITask
    {
        public void Run(string[] args)
        {
            RestApi.DbExporter("mysql");

            File.WriteAllText(@"../../JSON.txt", RestApi.Response);
            var jsonPath = @"../../JSON.txt";
            StringBuilder sb = new StringBuilder();
            using (var sr = new StreamReader(jsonPath))
            {
                string line;
                while ((line = sr.ReadLine()) != null)
                {
                    sb.AppendLine(line);
                }
            }
            byte[] bytes = Encoding.ASCII.GetBytes(sb.ToString());
            using (var stream = new MemoryStream(bytes))
            {
                var quotas = new XmlDictionaryReaderQuotas();
                var jsonReader = JsonReaderWriterFactory.CreateJsonReader(stream, quotas);
                var xml = XDocument.Load(jsonReader);
                Console.WriteLine(xml);
                // write to file instead
            }
        }
    }
}

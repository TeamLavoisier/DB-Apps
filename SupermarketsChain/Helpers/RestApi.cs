using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;

namespace SupermarketsChain.Helpers
{
    public class RestApi
    {
        private static string BaseURL = "http://localhost/dbApps-Core1.0/";

        public static string Response { get; private set; }

        public static void DbExporter(string dbType)
        {
            Contact("data/" + dbType);
        }

        public static void TableExporter(string dbType, string tableName)
        {
            Contact("data/" + dbType + "/" + tableName);
        }

        public static void Importer(string dbType, string dataType, string postData)
        {
            Contact("importer/" + dbType + "/" + dataType, "POST", postData);
        }

        private static void Contact(string param, string method = "GET", string postData = "")
        {
            var request = (HttpWebRequest)WebRequest.Create(BaseURL + param);

            if (method != "GET")
            {
                var data = Encoding.ASCII.GetBytes("data=" + postData);

                request.Method = method;
                request.ContentType = "application/x-www-form-urlencoded";
                request.ContentLength = data.Length;

                using (var stream = request.GetRequestStream())
                {
                    stream.Write(data, 0, data.Length);
                }
            }

            var response = (HttpWebResponse)request.GetResponse();

            var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();

            Response = responseString;
        }
    }
}

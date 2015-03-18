using System.Collections.Generic;
using System.Data.SqlTypes;

namespace DBPlayground
{
    using System;
    using System.IO;
    using System.Net;
    using System.Text;
    using SuperMarket.MySQL;

    using SuperMarket.Model;
    internal class Program
    {
        private static void Main(string[] args)
        {
            // Create MySQL Connection
            var dbMySQL = new DBConnect();
            var productsCount = dbMySQL.Count();
            // print number of products 
            Console.WriteLine(productsCount);

            // Create a request using a URL that can receive a post. 
            var response = GetResponse();
        
            // Create flat JSON from response

            string[] resp = response.ToString().Split(new char[] { ']' }, StringSplitOptions.RemoveEmptyEntries);

            var sales = resp[3].Substring(10).Split(new char[] { '}' }, StringSplitOptions.RemoveEmptyEntries);

            char[] delimiter = {','};
            List<Sale> totalSales = new List<Sale>();
            
            foreach (var sls in sales)
            {
                var s = sls.Split(delimiter, StringSplitOptions.RemoveEmptyEntries);

                var id = int.Parse(s[0].Substring(s[0].IndexOf(':') + 1));
                var soldOn = new DateTime(int.Parse(s[1].Substring(s[1].IndexOf(':') + 2, 4)), int.Parse(s[1].Substring(s[1].IndexOf(':') + 7, 2)), int.Parse(s[1].Substring(s[1].IndexOf(':') + 10, 2) ));
                var quantity = int.Parse(s[2].Substring(s[2].IndexOf(':') + 1));
                var pricePerUnit = decimal.Parse(s[3].Substring(s[3].IndexOf(':') + 1));
                var cost = decimal.Parse(s[4].Substring(s[4].IndexOf(':') + 1));
                var supermarketId = int.Parse(s[5].Substring(s[5].IndexOf(':') + 1));
                var productId = int.Parse(s[6].Substring(s[6].IndexOf(':') + 1));
            
                totalSales.Add(new Sale(id, soldOn, quantity, pricePerUnit, cost, supermarketId, productId));
            }

        }

        private static StringBuilder GetResponse()
        {
            StringBuilder sb = new StringBuilder();
            string url = "http://localhost/dbApps-Core1.0/data/mysql";
            // Creates an HttpWebRequest with the specified URL. 
            HttpWebRequest myHttpWebRequest = (HttpWebRequest) WebRequest.Create(url);
            // Sends the HttpWebRequest and waits for the response.			
            HttpWebResponse myHttpWebResponse = (HttpWebResponse) myHttpWebRequest.GetResponse();
            // Gets the stream associated with the response.
            Stream receiveStream = myHttpWebResponse.GetResponseStream();
            Encoding encode = System.Text.Encoding.GetEncoding("utf-8");
            // Pipes the stream to a higher level stream reader with the required encoding format. 
            StreamReader readStream = new StreamReader(receiveStream, encode);
            Char[] read = new Char[256];
            // Reads 256 characters at a time.     
            int count = readStream.Read(read, 0, 256);
            while (count > 0)
            {
                // Dumps the 256 characters on a string and displays the string to the console.
                String str = new String(read, 0, count);
                sb.Append(str);
                count = readStream.Read(read, 0, 256);
            }
            // Releases the resources of the response.
            myHttpWebResponse.Close();
            // Releases the resources of the Stream.
            readStream.Close();
            return sb;
        }
    }
}
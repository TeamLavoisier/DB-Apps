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
using Newtonsoft.Json;
using iTextSharp.text;
using iTextSharp.text.pdf;
using System.Web.Script.Serialization;

namespace SupermarketsChain.Tasks
{
    class GeneratePDF : ITask
    {
        public void Run(string[] args)
        {
            var db = new SupermarketDbContext();
            var current = DateTime.Parse(args[1]);
            var next = current.AddDays(1);

            var productsQuery = db.products
                .Where(p => p.sales.Any(s => s.sold_on >= current && s.sold_on <= next))
                .Select(p => new
                {
                    Name = p.name,
                    Quantity = p.sales.Select(s => s.quantity).Sum() + " " + p.measure.name,
                    UnitPrice = p.sales.Select(s => s.price_per_unit).FirstOrDefault(),
                    Location = p.sales.Select(s => s.supermarket.name).FirstOrDefault(),
                    Sum = p.sales.Select(s => s.quantity).Sum() * p.sales.Select(s => s.price_per_unit).FirstOrDefault()
                });

            var json = @"{
'ReportName': 'Aggregated Sales Report',";
            json += "'Date': '" + args[1] + "',";
            json += "'Products':";
            var jsonSerialiser = new JavaScriptSerializer();
            json += jsonSerialiser.Serialize(productsQuery.ToList());
            json += "}";
            var ReportEntityObj = JsonConvert.DeserializeObject<ReportEntity>(json);
            Document doc = new Document(iTextSharp.text.PageSize.LETTER, 10, 10, 42, 35);
            PdfWriter write = PdfWriter.GetInstance(doc, new FileStream("TestReport.pdf", FileMode.Create));
            doc.Open(); // open document to write
            // defining the font of the table
            Font arial = FontFactory.GetFont("Arial", 10, Font.BOLD, new BaseColor(125, 88, 15));
            // generating the table
            int tableRows = ReportEntityObj.products.Count;
            int tableCols = 5;
            PdfPTable table = new PdfPTable(tableCols);
            PdfPCell cellHeader = new PdfPCell(new Phrase(ReportEntityObj.ReportName, arial));
            cellHeader.Colspan = 5;
            cellHeader.HorizontalAlignment = 1; // 0=left, 1=center, 2=right
            table.AddCell(cellHeader);
            for (int i = 0; i < tableRows; i++)
            {
                table.AddCell((new Phrase(ReportEntityObj.products[i].Name.ToString(), arial)));
                table.AddCell((new Phrase(ReportEntityObj.products[i].Quantity.ToString(), arial)));
                table.AddCell((new Phrase(ReportEntityObj.products[i].UnitPrice.ToString(), arial)));
                table.AddCell((new Phrase(ReportEntityObj.products[i].Location.ToString(), arial)));
                table.AddCell((new Phrase(ReportEntityObj.products[i].Sum.ToString(), arial)));
            }
            var totalSum = ReportEntityObj.products.Sum(x => x.Sum);
            PdfPCell cellTotalSumForThePeriodStr =
            new PdfPCell(new Phrase("Total sum for " + ReportEntityObj.Date + ": ", arial));
            cellTotalSumForThePeriodStr.Colspan = 4;
            cellTotalSumForThePeriodStr.HorizontalAlignment = 2; // 0=left, 1=center, 2=right
            table.AddCell(cellTotalSumForThePeriodStr);
            PdfPCell cellTotalSum = new PdfPCell(new Phrase(totalSum.ToString(), arial));
            cellTotalSum.Colspan = 1;
            cellTotalSum.HorizontalAlignment = 2; // 0=left, 1=center, 2=right
            table.AddCell(cellTotalSum);
            doc.Add(table);
            doc.Close(); // close document to write
            System.Diagnostics.Process.Start("TestReport.pdf");
        }
    }

    class ReportEntity
    {
        public string ReportName { get; set; }
        public object Date { get; set; }
        public List<Product> products;
        public ReportEntity()
        {
            this.products = new List<Product>();
        }
    }

    class Product
    {
        public object Name { get; set; }
        public object Quantity { get; set; }
        public decimal UnitPrice { get; set; }
        public object Location { get; set; }
        public decimal Sum { get; set; }
    }
}

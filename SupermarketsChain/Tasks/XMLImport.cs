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
using System.Xml.XPath;

namespace SupermarketsChain.Tasks
{
    class XMLImport : ITask
    {
        public void Run()
        {
            var xmlDoc = XDocument.Load(@"..\..\Xml\expenses.xml");
            var vendorNodes = xmlDoc.XPathSelectElements("/expenses-by-month/vendor");
            var db = new SupermarketDbContext();

            foreach (var node in vendorNodes)
            {
                string vendorName = node.Attribute("name").Value;
                var expenseNodes = node.XPathSelectElements("expenses");

                var vendorInDb = db.vendors.FirstOrDefault(v => v.name == vendorName);

                foreach (var exp in expenseNodes)
                {
                    var month = exp.Attribute("month").Value;
                    var cnt = exp.Value;

                    vendor vendor;
                    if (vendorInDb == null)
                    {
                        vendor = new vendor()
                        {
                            name = vendorName
                        };

                        db.vendors.Add(vendor);
                    }
                    else
                    {
                        vendor = vendorInDb;
                    }

                    var expense = new expence()
                    {
                        created_on = DateTime.Parse(month),
                        name = "",
                        vendor = vendor
                    };

                    db.expences.Add(expense);
                }

               
            }

            db.SaveChanges();

        }
    }
}

using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using SupermarketsChain.Helpers;
using SupermarketsChain.Interfaces;


namespace SupermarketsChain.Tasks
{
    class MongoDBReports : ITask
    {
        public void Run()
        {
            var db = new SupermarketDbContext();

            var productsQuery = db.products
                .Select(p => new
                {
                    product_id = p.id,
                    product_name = p.name,
                    vendor_name = p.vendor.name,
                    total_quantity_sold = p.sales.Select(s => s.quantity).Sum(),
                    total_incomes = p.sales.Select(s => s.price_per_unit).Sum()
                }).ToList();

            // import Entity and to mongodb
            // convert to json and save in file system
        }
    }
}

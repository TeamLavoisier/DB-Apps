namespace SuperMarket.Model
{
    public class Product
    {
        public int Id { get; set; }
        
        public string Name { get; set; }
        
        public decimal Tax { get; set; }
        
        public int VendorId { get; set; }
        
        public int MeasureId { get; set; }
    }
}
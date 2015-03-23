-----------------------------------------------------------------------
-- expences
-----------------------------------------------------------------------

IF EXISTS (SELECT 1 FROM sysobjects WHERE type ='RI' AND name='expences_fk_31a63b')
    ALTER TABLE [expences] DROP CONSTRAINT [expences_fk_31a63b];

IF EXISTS (SELECT 1 FROM sysobjects WHERE type = 'U' AND name = 'expences')
BEGIN
    DECLARE @reftable_1 nvarchar(60), @constraintname_1 nvarchar(60)
    DECLARE refcursor CURSOR FOR
    select reftables.name tablename, cons.name constraintname
        from sysobjects tables,
            sysobjects reftables,
            sysobjects cons,
            sysreferences ref
        where tables.id = ref.rkeyid
            and cons.id = ref.constid
            and reftables.id = ref.fkeyid
            and tables.name = 'expences'
    OPEN refcursor
    FETCH NEXT from refcursor into @reftable_1, @constraintname_1
    while @@FETCH_STATUS = 0
    BEGIN
        exec ('alter table '+@reftable_1+' drop constraint '+@constraintname_1)
        FETCH NEXT from refcursor into @reftable_1, @constraintname_1
    END
    CLOSE refcursor
    DEALLOCATE refcursor
    DROP TABLE [expences]
END

CREATE TABLE [expences]
(
    [id] INT NOT NULL IDENTITY,
    [name] VARCHAR(255) NOT NULL,
    [created_on] DATETIME NOT NULL,
    [vendor_id] INT NOT NULL,
    CONSTRAINT [expences_pk] PRIMARY KEY ([id])
);



-----------------------------------------------------------------------
-- products
-----------------------------------------------------------------------

IF EXISTS (SELECT 1 FROM sysobjects WHERE type ='RI' AND name='products_fk_31a63b')
    ALTER TABLE [products] DROP CONSTRAINT [products_fk_31a63b];

IF EXISTS (SELECT 1 FROM sysobjects WHERE type ='RI' AND name='products_fk_418dc6')
    ALTER TABLE [products] DROP CONSTRAINT [products_fk_418dc6];

IF EXISTS (SELECT 1 FROM sysobjects WHERE type = 'U' AND name = 'products')
BEGIN
    DECLARE @reftable_2 nvarchar(60), @constraintname_2 nvarchar(60)
    DECLARE refcursor CURSOR FOR
    select reftables.name tablename, cons.name constraintname
        from sysobjects tables,
            sysobjects reftables,
            sysobjects cons,
            sysreferences ref
        where tables.id = ref.rkeyid
            and cons.id = ref.constid
            and reftables.id = ref.fkeyid
            and tables.name = 'products'
    OPEN refcursor
    FETCH NEXT from refcursor into @reftable_2, @constraintname_2
    while @@FETCH_STATUS = 0
    BEGIN
        exec ('alter table '+@reftable_2+' drop constraint '+@constraintname_2)
        FETCH NEXT from refcursor into @reftable_2, @constraintname_2
    END
    CLOSE refcursor
    DEALLOCATE refcursor
    DROP TABLE [products]
END

CREATE TABLE [products]
(
    [id] INT NOT NULL IDENTITY,
    [name] VARCHAR(128) NOT NULL,
    [tax] INT NOT NULL,
    [vendor_id] INT NOT NULL,
    [measure_id] INT NOT NULL,
    CONSTRAINT [products_pk] PRIMARY KEY ([id])
);



-----------------------------------------------------------------------
-- vendors
-----------------------------------------------------------------------

IF EXISTS (SELECT 1 FROM sysobjects WHERE type = 'U' AND name = 'vendors')
BEGIN
    DECLARE @reftable_3 nvarchar(60), @constraintname_3 nvarchar(60)
    DECLARE refcursor CURSOR FOR
    select reftables.name tablename, cons.name constraintname
        from sysobjects tables,
            sysobjects reftables,
            sysobjects cons,
            sysreferences ref
        where tables.id = ref.rkeyid
            and cons.id = ref.constid
            and reftables.id = ref.fkeyid
            and tables.name = 'vendors'
    OPEN refcursor
    FETCH NEXT from refcursor into @reftable_3, @constraintname_3
    while @@FETCH_STATUS = 0
    BEGIN
        exec ('alter table '+@reftable_3+' drop constraint '+@constraintname_3)
        FETCH NEXT from refcursor into @reftable_3, @constraintname_3
    END
    CLOSE refcursor
    DEALLOCATE refcursor
    DROP TABLE [vendors]
END

CREATE TABLE [vendors]
(
    [id] INT NOT NULL IDENTITY,
    [name] VARCHAR(128) NOT NULL,
    CONSTRAINT [vendors_pk] PRIMARY KEY ([id])
);

-----------------------------------------------------------------------
-- measures
-----------------------------------------------------------------------

IF EXISTS (SELECT 1 FROM sysobjects WHERE type = 'U' AND name = 'measures')
BEGIN
    DECLARE @reftable_4 nvarchar(60), @constraintname_4 nvarchar(60)
    DECLARE refcursor CURSOR FOR
    select reftables.name tablename, cons.name constraintname
        from sysobjects tables,
            sysobjects reftables,
            sysobjects cons,
            sysreferences ref
        where tables.id = ref.rkeyid
            and cons.id = ref.constid
            and reftables.id = ref.fkeyid
            and tables.name = 'measures'
    OPEN refcursor
    FETCH NEXT from refcursor into @reftable_4, @constraintname_4
    while @@FETCH_STATUS = 0
    BEGIN
        exec ('alter table '+@reftable_4+' drop constraint '+@constraintname_4)
        FETCH NEXT from refcursor into @reftable_4, @constraintname_4
    END
    CLOSE refcursor
    DEALLOCATE refcursor
    DROP TABLE [measures]
END

CREATE TABLE [measures]
(
    [id] INT NOT NULL IDENTITY,
    [name] VARCHAR(128) NOT NULL,
    CONSTRAINT [measures_pk] PRIMARY KEY ([id])
);

-----------------------------------------------------------------------
-- sales
-----------------------------------------------------------------------

IF EXISTS (SELECT 1 FROM sysobjects WHERE type ='RI' AND name='sales_fk_d90c10')
    ALTER TABLE [sales] DROP CONSTRAINT [sales_fk_d90c10];

IF EXISTS (SELECT 1 FROM sysobjects WHERE type ='RI' AND name='sales_fk_14cb72')
    ALTER TABLE [sales] DROP CONSTRAINT [sales_fk_14cb72];

IF EXISTS (SELECT 1 FROM sysobjects WHERE type = 'U' AND name = 'sales')
BEGIN
    DECLARE @reftable_5 nvarchar(60), @constraintname_5 nvarchar(60)
    DECLARE refcursor CURSOR FOR
    select reftables.name tablename, cons.name constraintname
        from sysobjects tables,
            sysobjects reftables,
            sysobjects cons,
            sysreferences ref
        where tables.id = ref.rkeyid
            and cons.id = ref.constid
            and reftables.id = ref.fkeyid
            and tables.name = 'sales'
    OPEN refcursor
    FETCH NEXT from refcursor into @reftable_5, @constraintname_5
    while @@FETCH_STATUS = 0
    BEGIN
        exec ('alter table '+@reftable_5+' drop constraint '+@constraintname_5)
        FETCH NEXT from refcursor into @reftable_5, @constraintname_5
    END
    CLOSE refcursor
    DEALLOCATE refcursor
    DROP TABLE [sales]
END

CREATE TABLE [sales]
(
    [id] INT NOT NULL IDENTITY,
    [sold_on] DATETIME NOT NULL,
    [quantity] INT NOT NULL,
    [price_per_unit] INT NOT NULL,
    [cost] INT NOT NULL,
    [supermarket_id] INT NOT NULL,
    [product_id] INT NOT NULL,
    CONSTRAINT [sales_pk] PRIMARY KEY ([id])
);



-----------------------------------------------------------------------
-- supermarkets
-----------------------------------------------------------------------

IF EXISTS (SELECT 1 FROM sysobjects WHERE type ='RI' AND name='supermarkets_fk_403fae')
    ALTER TABLE [supermarkets] DROP CONSTRAINT [supermarkets_fk_403fae];

IF EXISTS (SELECT 1 FROM sysobjects WHERE type = 'U' AND name = 'supermarkets')
BEGIN
    DECLARE @reftable_6 nvarchar(60), @constraintname_6 nvarchar(60)
    DECLARE refcursor CURSOR FOR
    select reftables.name tablename, cons.name constraintname
        from sysobjects tables,
            sysobjects reftables,
            sysobjects cons,
            sysreferences ref
        where tables.id = ref.rkeyid
            and cons.id = ref.constid
            and reftables.id = ref.fkeyid
            and tables.name = 'supermarkets'
    OPEN refcursor
    FETCH NEXT from refcursor into @reftable_6, @constraintname_6
    while @@FETCH_STATUS = 0
    BEGIN
        exec ('alter table '+@reftable_6+' drop constraint '+@constraintname_6)
        FETCH NEXT from refcursor into @reftable_6, @constraintname_6
    END
    CLOSE refcursor
    DEALLOCATE refcursor
    DROP TABLE [supermarkets]
END

CREATE TABLE [supermarkets]
(
    [id] INT NOT NULL IDENTITY,
    [name] VARCHAR(128) NOT NULL,
    [town_id] INT NOT NULL,
    CONSTRAINT [supermarkets_pk] PRIMARY KEY ([id])
);



-----------------------------------------------------------------------
-- towns
-----------------------------------------------------------------------

IF EXISTS (SELECT 1 FROM sysobjects WHERE type = 'U' AND name = 'towns')
BEGIN
    DECLARE @reftable_7 nvarchar(60), @constraintname_7 nvarchar(60)
    DECLARE refcursor CURSOR FOR
    select reftables.name tablename, cons.name constraintname
        from sysobjects tables,
            sysobjects reftables,
            sysobjects cons,
            sysreferences ref
        where tables.id = ref.rkeyid
            and cons.id = ref.constid
            and reftables.id = ref.fkeyid
            and tables.name = 'towns'
    OPEN refcursor
    FETCH NEXT from refcursor into @reftable_7, @constraintname_7
    while @@FETCH_STATUS = 0
    BEGIN
        exec ('alter table '+@reftable_7+' drop constraint '+@constraintname_7)
        FETCH NEXT from refcursor into @reftable_7, @constraintname_7
    END
    CLOSE refcursor
    DEALLOCATE refcursor
    DROP TABLE [towns]
END

CREATE TABLE [towns]
(
    [id] INT NOT NULL IDENTITY,
    [name] VARCHAR(128) NOT NULL,
    CONSTRAINT [towns_pk] PRIMARY KEY ([id])
);

BEGIN
ALTER TABLE [expences] ADD CONSTRAINT [expences_fk_31a63b] FOREIGN KEY ([vendor_id]) REFERENCES [vendors] ([id])
END
;
BEGIN
ALTER TABLE [products] ADD CONSTRAINT [products_fk_31a63b] FOREIGN KEY ([vendor_id]) REFERENCES [vendors] ([id])
END
;

BEGIN
ALTER TABLE [products] ADD CONSTRAINT [products_fk_418dc6] FOREIGN KEY ([measure_id]) REFERENCES [measures] ([id])
END
;
BEGIN
ALTER TABLE [sales] ADD CONSTRAINT [sales_fk_d90c10] FOREIGN KEY ([product_id]) REFERENCES [products] ([id])
END
;

BEGIN
ALTER TABLE [sales] ADD CONSTRAINT [sales_fk_14cb72] FOREIGN KEY ([supermarket_id]) REFERENCES [supermarkets] ([id])
END
;
BEGIN
ALTER TABLE [supermarkets] ADD CONSTRAINT [supermarkets_fk_403fae] FOREIGN KEY ([town_id]) REFERENCES [towns] ([id])
END
;
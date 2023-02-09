USE [lbpsb_project]
GO

INSERT INTO [dbo].[employees]
           ([school_id]
           ,[first_name]
           ,[last_name]
           ,[address]
           ,[phone_number]
           ,[hire_date]
           ,[birth_date]
           ,[email]
           ,[username]
           ,[password])
     VALUES
(
		   6,
           'Dharmik',
           'Patel',
           '222 tieyourshoe boul.',
           4381234567,
           '2001-09-11',
           '1990-01-02',
           'dpatel11@pearson.ca',
           'dpatel11',
           'BunnyRunsAroundTr_33'
)
GO



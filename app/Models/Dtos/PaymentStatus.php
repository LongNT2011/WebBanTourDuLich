<?php
namespace App\Models\Dtos;
class Status
{
    public const StatusPending = "Pending";
    public const StatusApproved = "Approved";
    public const StatusCheckedIn = "CheckedIn";
    public const StatusCompleted = "Completed";
    public const StatusCancelled = "Cancelled";
    public const StatusRefunded = "Refunded";
}